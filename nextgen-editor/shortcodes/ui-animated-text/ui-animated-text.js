window.nextgenEditor.addShortcode('ui-animated-text', {
  type: 'inline',
  plugin: 'shortcode-ui',
  title: 'UI Animated Text',
  button: {
    group: 'shortcode-ui',
    label: 'UI Animated Text',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M1.091 7.248a1.048 1.048 0 00-1.091 1v7a1.048 1.048 0 001.091 1H14a1 1 0 001-1v-7a1 1 0 00-1-1zM22.909 7.248H21a1 1 0 00-1 1v7a1 1 0 001 1h1.909a1.048 1.048 0 001.091-1v-7a1.048 1.048 0 00-1.091-1z"/><path d="M18.5 7.248a3.043 3.043 0 013-3 1 1 0 000-2 4.994 4.994 0 00-3.81 1.765.248.248 0 01-.19.088.252.252 0 01-.191-.088A4.991 4.991 0 0013.5 2.248a1 1 0 000 2 3.043 3.043 0 013 3v9.5a2.942 2.942 0 01-.051.5 3 3 0 01-2.949 2.5 1 1 0 000 2 4.994 4.994 0 003.81-1.765.248.248 0 01.19-.088.255.255 0 01.191.088 4.991 4.991 0 003.809 1.765 1 1 0 000-2 3 3 0 01-2.949-2.5 2.942 2.942 0 01-.051-.5z"/></svg>',
  },
  attributes: {
    words: {
      type: String,
      title: 'Words',
      widget: 'input-text',
      default: 'cool, funky, fresh',
    },
    element: {
      type: String,
      title: 'Element',
      widget: 'input-text',
      default: 'h1',
    },
    animation: {
      type: String,
      title: 'Animation',
      widget: {
        type: 'select',
        values: [
          { value: 'type', label: 'Typing'},
          { value: 'loading-bar', label: 'Loading Bar'},
          { value: 'slide', label: 'Slide'},
          { value: 'scale', label: 'Scale'},
          { value: 'clip', label: 'Clip'},
          { value: 'zoom', label: 'Zoom'},
          { value: 'push', label: 'Push'},
          { value: 'rotate-1', label: 'Rotate 1'},
          { value: 'rotate-2', label: 'Rotate 2'},
          { value: 'rotate-3', label: 'Rotate 3'},
        ],
      },
      default: 'rotate-1',
    },
  },
  content() {
    return '{{content_editable}}';
  },
});
