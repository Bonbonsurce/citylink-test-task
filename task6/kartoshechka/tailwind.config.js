module.exports = {
  content: ['./public/index.html', './src/**/*.{vue,js}'],
  theme: {
    extend: {
      screens: {
        md: '48.0625rem',
        xl: '68.75rem',
      },
      fontFamily: {
        sans: ['Montserrat', 'sans-serif'],
      },
      colors: {
        text: {
          DEFAULT: '#2b2b2b',
          muted: '#666666',
        },
        accent: {
          DEFAULT: '#d4a017',
          light: '#e0b13a',
          hover: '#ecba46',
          'filled-hover': '#f0d078',
        },
        dark: {
          DEFAULT: '#35312d',
          deep: '#201e1c',
          footer: '#33312b',
        },
        social: {
          bg: '#e8e8e8',
          icon: '#9a9a9a',
        },
      },
      maxWidth: {
        container: '73.125rem',
        about: '57.5rem',
        'about-wide': '60.25rem',
      },
      borderRadius: {
        card: '1.5rem',
        player: '1rem',
      },
      spacing: {
        header: '5rem',
      },
    },
  },
  plugins: [],
}
