module.exports = {
  extends: ["stylelint-config-standard"],
  rules: {
    // Enable BEM-friendly pattern that allows both BEM and kebab-case
    "selector-class-pattern": "^[a-z][a-z0-9]*(-[a-z0-9]+)*(__[a-z0-9]+(-[a-z0-9]+)*)?(--[a-z0-9]+(-[a-z0-9]+)*)?$",

    // Allow snake_case and kebab-case for CSS custom properties
    "custom-property-pattern": "^[a-z][a-z0-9]*(-[a-z0-9]+)*(__[a-z0-9]+(-[a-z0-9]+)*)?$",

    // Allow both currentColor and currentcolor
    "value-keyword-case": ["lower", {
      ignoreKeywords: ["currentColor"]
    }],

    // Disable redundant longhand properties rule to allow explicit CSS properties
    "declaration-block-no-redundant-longhand-properties": null,

    // Disable Disallow selectors of lower specificity from coming after overriding selectors of higher specificity.
    "no-descending-specificity": null,

    // Optional: allow unknown at-rules like `@layer`, `@nest`, `@container`, etc.
    "at-rule-no-unknown": [true, {
      ignoreAtRules: ["nest", "layer", "container", "media", "supports"]
    }]
  }
};
