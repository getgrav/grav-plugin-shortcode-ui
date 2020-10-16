window.nextgenEditor.addShortcode('ui-polaroid', {
  type: 'block',
  plugin: 'shortcode-ui',
  title: 'UI Polaroid',
  button: {
    group: 'shortcode-ui',
    label: 'UI Polaroid',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.4 14a.25.25 0 00.224-.361l-1.239-2.5a.251.251 0 00-.229-.139H1.844a.251.251 0 00-.224.139l-1.239 2.5A.25.25 0 00.605 14zM.25 15a.25.25 0 00-.25.25V18a2 2 0 002 2h1.06a.25.25 0 01.218.128.247.247 0 010 .252 11.525 11.525 0 01-.833 1.187A1.5 1.5 0 003.615 24h16.674a1.5 1.5 0 001.144-2.471 8.489 8.489 0 01-.826-1.15.249.249 0 01.214-.379H22a2 2 0 002-2v-2.75a.25.25 0 00-.25-.25zm18.55 6.251a.5.5 0 01-.434.749H5.517a.5.5 0 01-.431-.753 10.748 10.748 0 001.247-3.053.249.249 0 01.244-.194H17.4a.25.25 0 01.245.2 10.025 10.025 0 001.155 3.051zM21.75 10a.25.25 0 00.25-.25V3.5A3.5 3.5 0 0018.5 0h-13A3.5 3.5 0 002 3.5v6.254a.25.25 0 00.25.25zM12 8a3 3 0 113-3 3 3 0 01-3 3zm7-4h-1.5a1 1 0 010-2H19a1 1 0 010 2z"/></svg>',
  },
  attributes: {
    title: {
      type: String,
      title: 'Title',
      widget: 'input-text',
      default: '',
    },
    position: {
      type: String,
      title: 'Position',
      widget: {
        type: 'select',
        values: [
          { value: 'left', label: 'Left'},
          { value: 'right', label: 'Right'},
        ],
      },
      default: 'left',
    },
    angle: {
      type: String,
      title: 'Angle',
      widget: 'input-text',
      default: '',
    },
    class: {
      type: String,
      title: 'Class',
      widget: 'input-text',
      default: '',
    },
    margin: {
      type: String,
      title: 'Margin',
      widget: 'input-text',
      default: '',
    },
    gloss: {
      type: String,
      title: 'Gloss',
      widget: {
        type: 'radios',
        values: [
          { value: 'true', label: 'True'},
          { value: 'false', label: 'False'},
        ],
      },
      default: 'true',
    },

  },
  titlebar({attributes }) {
    return []
      .concat([
        attributes.title ? `title: <strong>${attributes.title}</strong>` : null,
        attributes.position ? `position: <strong>${attributes.position}</strong>` : null,
      ])
      .filter((item) => !!item)
      .join(', ');
  },
  content() {
    return `<div>{{content_editable}}</div>`;
  },
});
