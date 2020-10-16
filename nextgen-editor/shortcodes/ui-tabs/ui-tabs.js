window.nextgenEditor.addShortcode('ui-tabs', {
  type: 'block',
  plugin: 'shortcode-ui',
  title: 'UI Tabs',
  button: {
    group: 'shortcode-ui',
    label: 'UI Tabs',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22.5 2a2 2 0 00-2-2h-17a2 2 0 00-2 2v20.165A1.835 1.835 0 003.333 24H20.5a2 2 0 002-2zm-19 .5A.5.5 0 014 2h16a.5.5 0 01.5.5v1.225a.251.251 0 01-.138.224l-2.2 1.1A2.984 2.984 0 0016.5 7.734v14.014a.25.25 0 01-.25.25H4a.5.5 0 01-.5-.5zm15 5.236a.994.994 0 01.553-.894l1.085-.542a.25.25 0 01.362.224v3.2a.251.251 0 01-.138.224l-1.5.75a.25.25 0 01-.362-.224zm2 8.491a.251.251 0 01-.138.224l-1.5.75a.25.25 0 01-.362-.224v-3.7a.252.252 0 01.138-.224l1.5-.75a.25.25 0 01.362.224zm-2 3.546a.252.252 0 01.138-.224l1.5-.75a.25.25 0 01.362.224V21.5a.5.5 0 01-.5.5h-1.25a.25.25 0 01-.25-.25z"/></svg>',
  },
  attributes: {
    theme: {
      type: String,
      title: 'Theme',
      widget: {
        type: 'radios',
        values: [
          { value: 'default', label: 'Default' },
          { value: 'lite', label: 'Lite' },
          { value: 'badges', label: 'Badges' },
        ],
      },
      default: 'default',
    },
    position: {
      type: String,
      title: 'Position',
      widget: {
        type: 'radios',
        values: [
          { value: 'top-left', label: 'Top Left' },
          { value: 'top-right', label: 'Top Right' },
          { value: 'bottom-left', label: 'Bottom Left' },
          { value: 'bottom-right', label: 'Bottom Right' },
        ],
      },
      default: 'top-left',
    },
    active: {
      type: Number,
      title: 'Active Tab',
      widget: {
        type: 'radios',
        values: ({ childAttributes }) => childAttributes.map((child, index) => ({
          value: index,
          label: child.title,
        })),
      },
      default: 0,
    },
  },
  titlebar({ attributes, childAttributes }) {
    const active = childAttributes[attributes.active];

    const theme = attributes.theme
      ? this.attributes.theme.widget.values.find((item) => item.value === attributes.theme)
      : '';

    const position = attributes.position
      ? this.attributes.position.widget.values.find((item) => item.value === attributes.position)
      : '';

    return []
      .concat([
        theme ? `theme: <strong>${theme.label}</strong>` : null,
        position ? `position: <strong>${position.label}</strong>` : null,
        active ? `active: <strong>${active.title}</strong>` : null,
      ])
      .filter((item) => !!item)
      .join(', ');
  },
  content() {
    return '{{content_readonly}}';
  },
});

window.nextgenEditor.addShortcode('ui-tab', {
  type: 'block',
  plugin: 'shortcode-ui',
  parent: 'ui-tabs',
  title: 'UI Tab',
  attributes: {
    id: {
      type: String,
      title: 'ID',
      widget: 'input-text',
      default: '',
    },
    title: {
      type: String,
      title: 'Title',
      widget: 'input-text',
      default: '',
    },
  },
  titlebar({ attributes }) {
    return `title: <strong>${attributes.title || ''}</strong>`;
  },
  content() {
    return '{{content_editable}}';
  },
});
