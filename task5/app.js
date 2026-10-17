(function () {
  const form = document.getElementById('participants-form');
  const input = document.getElementById('participants');
  const addButton = document.getElementById('add-button');
  const results = document.getElementById('results');
  const tbody = document.getElementById('participants-body');
  const error = document.getElementById('participants-error');

  const participants = [];
  let nextId = 1;
  let sortKey = null;
  let sortDir = 1;
  let loading = false;

  function allowedText(value) {
    return value.replace(/[^\p{Script=Cyrillic},]/gu, '');
  }

  function showError(message) {
    input.classList.add('is-invalid');
    error.textContent = message;
  }

  function clearError() {
    input.classList.remove('is-invalid');
    error.textContent = '';
  }

  function blockDisallowedCharacters(event) {
    if (event.inputType !== 'insertText' || !event.data) {
      return;
    }

    if (allowedText(event.data) !== event.data) {
      event.preventDefault();
    }
  }

  function sanitizeField() {
    const value = allowedText(input.value);

    if (value !== input.value) {
      input.value = value;
    }

    clearError();
  }

  function readNames() {
    if (input.value === '') {
      return { error: 'Поле должно быть заполнено.' };
    }

    const names = input.value.split(',');
    const hasEmptyName = names.some((name) => !/^\p{Script=Cyrillic}+$/u.test(name));

    if (hasEmptyName) {
      return { error: 'Имя участника не может быть пустым. Уберите запятую в начале, в конце или две запятые подряд.' };
    }

    return { names };
  }

  function compareParticipants(a, b) {
    const diff = sortKey === 'name'
      ? a.name.localeCompare(b.name, 'ru')
      : a[sortKey] - b[sortKey];

    return (diff || a.id - b.id) * sortDir;
  }

  function participantsForTable() {
    if (!sortKey) {
      return participants;
    }

    return participants.toSorted(compareParticipants);
  }

  function createRow(person) {
    const row = document.createElement('tr');

    [person.id, person.name, person.score].forEach((value) => {
      const cell = document.createElement('td');
      cell.textContent = value;
      row.append(cell);
    });

    return row;
  }

  function updateSortButtons() {
    document.querySelectorAll('.sort-btn').forEach((button) => {
      const active = button.dataset.sort === sortKey;
      const direction = active ? (sortDir > 0 ? 'ascending' : 'descending') : 'none';
      const icon = active ? (sortDir > 0 ? '↑' : '↓') : '↕';

      button.closest('th').setAttribute('aria-sort', direction);
      button.dataset.direction = direction;
      button.querySelector('.sort-icon').textContent = icon;
    });
  }

  function renderTable() {
    tbody.replaceChildren(...participantsForTable().map(createRow));
    updateSortButtons();
  }

  function sortBy(key) {
    sortDir = sortKey === key ? -sortDir : 1;
    sortKey = key;
    renderTable();
  }

  async function requestScores(names) {
    const response = await fetch('scores.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ names }),
    });
    const scores = await response.json();

    if (!response.ok || !Array.isArray(scores) || scores.length !== names.length) {
      throw new Error('Не удалось получить очки участников.');
    }

    return scores;
  }

  function appendParticipants(names, scores) {
    names.forEach((name, index) => {
      participants.push({
        id: nextId,
        name,
        score: scores[index],
      });
      nextId += 1;
    });

    results.classList.remove('d-none');
    renderTable();
    input.value = '';
    clearError();
  }

  async function submitParticipants(event) {
    event.preventDefault();

    if (loading) {
      return;
    }

    const parsed = readNames();

    if (parsed.error) {
      showError(parsed.error);
      return;
    }

    loading = true;
    addButton.disabled = true;

    try {
      const scores = await requestScores(parsed.names);
      appendParticipants(parsed.names, scores);
    } catch (requestError) {
      showError('Не удалось связаться с сервером. Откройте страницу через PHP и попробуйте ещё раз.');
    } finally {
      loading = false;
      addButton.disabled = false;
    }
  }

  input.addEventListener('beforeinput', blockDisallowedCharacters);
  input.addEventListener('input', sanitizeField);
  document.querySelectorAll('.sort-btn').forEach((button) => {
    button.addEventListener('click', () => sortBy(button.dataset.sort));
  });
  form.addEventListener('submit', submitParticipants);
})();
