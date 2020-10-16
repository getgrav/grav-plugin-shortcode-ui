window.nextgenEditor.addShortcode('ui-browser', {
  type: 'block',
  plugin: 'shortcode-ui',
  title: 'UI Browser',
  button: {
    group: 'shortcode-ui',
    label: 'UI Browser',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="4" y="8.25" style="width:16px;height:3px;" rx=".5" ry=".5"/><path d="M13.25 12.75a.75.75 0 000 1.5h6a.75.75 0 000-1.5zM19.25 16.25h-6a.75.75 0 000 1.5h6a.75.75 0 000-1.5z"/><rect x="4" y="12.75" style="width:7px;height:6.5px" rx="1" ry="1"/><path d="M24 4.75a3 3 0 00-3-3H3a3 3 0 00-3 3v14.5a3 3 0 003 3h18a3 3 0 003-3zm-14.346-1a.966.966 0 011.692 0 .969.969 0 01.154.5.969.969 0 01-.154.5.966.966 0 01-1.692 0 .969.969 0 01-.154-.5.969.969 0 01.154-.5zm-3.5 0a.966.966 0 011.692 0 .969.969 0 01.154.5.969.969 0 01-.154.5.966.966 0 01-1.692 0A.969.969 0 016 4.25a.969.969 0 01.154-.5zm-3.562.092A1 1 0 013.5 3.25a.985.985 0 01.846.5.969.969 0 01.154.5.969.969 0 01-.154.5.966.966 0 01-1.692 0 .969.969 0 01-.154-.5.979.979 0 01.092-.408zM22 19.25a1 1 0 01-1 1H3a1 1 0 01-1-1V7a.25.25 0 01.25-.25h19.5A.25.25 0 0122 7z"/></svg>',
  },
  attributes: {
    address: {
      type: String,
      title: 'Address',
      widget: 'input-text',
      default: '',
    },
    class: {
      type: String,
      title: 'Class',
      widget: 'input-text',
      default: '',
    },
  },
  titlebar({ attributes }) {
    return `address: <strong>${attributes.address}</strong>`;
  },
  content() {
    return `<div>{{content_editable}}</div>`;
  },
});
