window.nextgenEditor.addShortcode('ui-tabs', {
  type: 'block',
  plugin: 'shortcode-ui',
  title: 'UI Tabs',
  button: {
    group: 'shortcode-ui',
    label: 'UI Tabs',
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
