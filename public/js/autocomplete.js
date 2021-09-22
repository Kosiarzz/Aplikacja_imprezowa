/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/autocomplete.js ***!
  \**************************************/
$(function () {
  $(".autocomplete").autocomplete({
    source: base_url + "/searchCities",
    minLength: 2,
    select: function select(event, ui) {
      console.log(ui.item.value);
    }
  });
});
/******/ })()
;