window.nextgenEditor.addShortcode('ui-accordion', {
  type: 'block',
  plugin: 'shortcode-ui',
  title: 'UI Accordion',
  button: {
    group: 'shortcode-ui',
    label: 'UI Accordion',
  },
  attributes: {
    independent: {
      type: String,
      title: 'Independent',
      widget: {
        type: 'checkbox',
        valueType: String,
        label: 'Yes',
      },
      default: 'false',
    },
    open: {
      type: String,
      title: 'Open Section',
      widget: {
        type: 'radios',
        values: ({ childAttributes }) => [
          { value: 'all', label: 'All Open' },
          { value: 'none', label: 'All Closed' },
          ...childAttributes.map((child, index) => ({
            value: index,
            label: child.title,
          })),
        ],
      },
      default: 'all',
    },
  },
  titlebar({ attributes, childAttributes }) {
    const independent = attributes.independent === 'true'
      ? 'Yes'
      : 'No';

    const openValues = this.attributes.open.widget.values({ childAttributes })
      .reduce((acc, item) => ({ ...acc, [item.value]: item.label }), {});

    const openValue = !Number.isNaN(+attributes.open) && childAttributes[attributes.open]
      ? childAttributes[attributes.open].title
      : openValues[attributes.open];

    return `independent: <strong>${independent}</strong>, open: <strong>${openValue}</strong>`;
  },
  content() {
    return '{{content_readonly}}';
  },
});

window.nextgenEditor.addShortcode('ui-accordion-item', {
  type: 'block',
  plugin: 'shortcode-ui',
  parent: 'ui-accordion',
  title: 'UI Accordion Item',
  attributes: {
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
