import html from "@html-eslint/eslint-plugin";
import parser from "@html-eslint/parser";

export default [
  // recommended configuration included in the plugin
  html.configs["flat/recommended"],
  // your own configurations.
  {
    files: ["**/*.html"],
    plugins: {
      "@html-eslint": html,
    },
    languageOptions: {
      parser,
    },
    rules: {
      "@html-eslint/indent": "error",
    },
  },
];