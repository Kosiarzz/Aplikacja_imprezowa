/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/notifications.js ***!
  \***************************************/
function GetNotShownNotify() {
  $.ajax({
    cache: false,
    url: base_url + '/getNotShownNotify',
    type: "GET",
    success: function success(response) {},
    beforeSend: function beforeSend() {}
  });
}
/******/ })()
;