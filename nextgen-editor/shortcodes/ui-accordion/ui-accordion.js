window.nextgenEditor.addShortcode('ui-accordion', {
  type: 'block',
  plugin: 'shortcode-ui',
  title: 'UI Accordion',
  button: {
    group: 'shortcode-ui',
    label: 'UI Accordion',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M9.512 16.28a.5.5 0 00-.615-.349l-2.635.728A.5.5 0 016 15.7l2.635-.729a.5.5 0 00.348-.615l-.4-1.463a.5.5 0 00-.615-.349l-2.842.786a.5.5 0 01-.266-.964l2.841-.786a.5.5 0 00.349-.615l-.131-.472a.5.5 0 00-.619-.353c-.938.261-2.916.808-2.916.808a.5.5 0 11-.265-.963s1.977-.547 2.915-.8a.5.5 0 00.349-.615l-.147-.532a.5.5 0 00-.615-.348L3.6 8.521a.5.5 0 01-.266-.964l3.02-.833a.5.5 0 00.3-.236.5.5 0 00.047-.38l-.128-.465A1.5 1.5 0 004.727 4.6l-2.892.8A2.5 2.5 0 00.092 8.472l2.664 9.638a2.5 2.5 0 003.075 1.743l2.893-.8a1.5 1.5 0 001.045-1.846zM23.9 8.517a2.5 2.5 0 00-1.684-3.108l-2.876-.855a1.5 1.5 0 00-1.87 1.011l-3.418 11.5a1.5 1.5 0 001.012 1.865l2.875.854a2.5 2.5 0 003.11-1.685zm-4.939 7.8a1 1 0 11-.673-1.243 1 1 0 01.669 1.239zm1.127-3.924a1 1 0 11-.674-1.243 1 1 0 01.67 1.239zm1.273-4.1a1 1 0 11-.674-1.243 1 1 0 01.67 1.235zM12 4.055a.75.75 0 00-.75.75v8.5a.75.75 0 001.5 0v-8.5a.75.75 0 00-.75-.75zM9.742 5.2a.75.75 0 00-1.485.212l.861 6.02a.75.75 0 101.484-.212zM14.882 11.431l.86-6.02a.75.75 0 00-1.485-.211l-.859 6.02a.75.75 0 101.484.212z"/></svg>',
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
