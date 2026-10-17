export function scrollToAnchor(href, onDone) {
  const id = href.replace('#', '')
  const el = document.getElementById(id)
  if (el) {
    el.scrollIntoView({ behavior: 'smooth', block: 'start' })
  }
  if (typeof onDone === 'function') {
    onDone()
  }
}
