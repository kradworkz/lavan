"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Pages_settings_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/Pages/settings.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/Pages/settings.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      currentUrl: window.location.origin,
      errors: [],
      current_password: '',
      password: '',
      password_confirmation: ''
    };
  },
  methods: {
    onSubmit: function onSubmit(evt) {
      var _this = this;

      evt.preventDefault();
      axios.post(this.currentUrl + '/request/user/password', {
        current_password: this.current_password,
        password: this.password,
        password_confirmation: this.password_confirmation
      }).then(function (response) {
        if (response.data.success == "First Attempt") {
          alert('wew');
        } else {
          _this.current_password = '';
          _this.password = '';
          _this.password_confirmation = '';
          _this.errors = [];
          _this.test = '';
          Vue.$toast.success('<strong>Password Changed</strong>', {
            position: 'bottom-right'
          });
        }
      })["catch"](function (error) {
        if (error.response.status == 422) {
          _this.errors = error.response.data.errors;
        }

        if (error.response.status == 401) {
          _this.errors = error.response.data.error;
          Vue.$toast.error('<strong>Password didn`t matched</strong>', {
            position: 'bottom-right'
          });
        }
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/Pages/settings.vue":
/*!*****************************************!*\
  !*** ./resources/js/Pages/settings.vue ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _settings_vue_vue_type_template_id_1fe6652c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./settings.vue?vue&type=template&id=1fe6652c& */ "./resources/js/Pages/settings.vue?vue&type=template&id=1fe6652c&");
/* harmony import */ var _settings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./settings.vue?vue&type=script&lang=js& */ "./resources/js/Pages/settings.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _settings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _settings_vue_vue_type_template_id_1fe6652c___WEBPACK_IMPORTED_MODULE_0__.render,
  _settings_vue_vue_type_template_id_1fe6652c___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/Pages/settings.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/Pages/settings.vue?vue&type=script&lang=js&":
/*!******************************************************************!*\
  !*** ./resources/js/Pages/settings.vue?vue&type=script&lang=js& ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_settings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./settings.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/Pages/settings.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_settings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/Pages/settings.vue?vue&type=template&id=1fe6652c&":
/*!************************************************************************!*\
  !*** ./resources/js/Pages/settings.vue?vue&type=template&id=1fe6652c& ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_settings_vue_vue_type_template_id_1fe6652c___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_settings_vue_vue_type_template_id_1fe6652c___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_settings_vue_vue_type_template_id_1fe6652c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./settings.vue?vue&type=template&id=1fe6652c& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/Pages/settings.vue?vue&type=template&id=1fe6652c&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/Pages/settings.vue?vue&type=template&id=1fe6652c&":
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/Pages/settings.vue?vue&type=template&id=1fe6652c& ***!
  \***************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm._m(0),
    _vm._v(" "),
    _c("div", { staticClass: "d-xl-flex" }, [
      _c("div", { staticClass: "w-100" }, [
        _c("div", { staticClass: "card" }, [
          _c("div", { staticClass: "card-body" }, [
            _c("h4", { staticClass: "card-title mb-4" }, [_vm._v("Settings")]),
            _vm._v(" "),
            _c("p", { staticClass: "text-muted mb-4" }, [
              _vm._v(
                "Dont' use easy-to-guess passwords, instead of trying to remember a different complex strong password."
              ),
            ]),
            _vm._v(" "),
            _c(
              "form",
              {
                staticClass: "customerform",
                on: {
                  submit: function ($event) {
                    $event.preventDefault()
                    return _vm.onSubmit.apply(null, arguments)
                  },
                },
              },
              [
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-12" }, [
                    _c("div", { staticClass: "form-group" }, [
                      _c("label", [
                        _vm._v("Current Password: "),
                        _vm.errors.current_password
                          ? _c("span", { staticClass: "haveerror" }, [
                              _vm._v(
                                "(" +
                                  _vm._s(_vm.errors.current_password[0]) +
                                  ")"
                              ),
                            ])
                          : _vm._e(),
                      ]),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.current_password,
                            expression: "current_password",
                          },
                        ],
                        staticClass: "form-control",
                        class: [
                          _vm.errors.current_password ? "is-invalid" : "",
                        ],
                        attrs: { type: "password" },
                        domProps: { value: _vm.current_password },
                        on: {
                          input: function ($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.current_password = $event.target.value
                          },
                        },
                      }),
                    ]),
                  ]),
                  _vm._v(" "),
                  _vm._m(1),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-12" }, [
                    _c("div", { staticClass: "form-group" }, [
                      _c("label", [
                        _vm._v("New Password: "),
                        _vm.errors.password
                          ? _c("span", { staticClass: "haveerror" }, [
                              _vm._v(
                                "(" + _vm._s(_vm.errors.password[0]) + ")"
                              ),
                            ])
                          : _vm._e(),
                      ]),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.password,
                            expression: "password",
                          },
                        ],
                        staticClass: "form-control",
                        class: [_vm.errors.password ? "is-invalid" : ""],
                        attrs: { type: "password" },
                        domProps: { value: _vm.password },
                        on: {
                          input: function ($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.password = $event.target.value
                          },
                        },
                      }),
                    ]),
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-12" }, [
                    _c("div", { staticClass: "form-group" }, [
                      _c("label", [
                        _vm._v("Confirm Password: "),
                        _vm.errors.password_confirmation
                          ? _c("span", { staticClass: "haveerror" }, [
                              _vm._v(
                                "(" +
                                  _vm._s(_vm.errors.password_confirmation[0]) +
                                  ")"
                              ),
                            ])
                          : _vm._e(),
                      ]),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.password_confirmation,
                            expression: "password_confirmation",
                          },
                        ],
                        staticClass: "form-control",
                        class: [
                          _vm.errors.password_confirmation ? "is-invalid" : "",
                        ],
                        attrs: { type: "password" },
                        domProps: { value: _vm.password_confirmation },
                        on: {
                          input: function ($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.password_confirmation = $event.target.value
                          },
                        },
                      }),
                    ]),
                  ]),
                  _vm._v(" "),
                  _vm._m(2),
                ]),
              ]
            ),
          ]),
        ]),
      ]),
    ]),
  ])
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "row mb-0" }, [
      _c(
        "div",
        { staticClass: "col-12", staticStyle: { "margin-bottom": "-10px" } },
        [
          _c(
            "div",
            {
              staticClass:
                "page-title-box d-flex align-items-center justify-content-between",
            },
            [
              _c("h4", [
                _c(
                  "span",
                  { staticClass: "mb-0 font-size-13 font-weight-bold" },
                  [_vm._v("User Profile")]
                ),
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "page-title-right font-size-11" }, [
                _c("ol", { staticClass: "breadcrumb m-0" }, [
                  _c("li", { staticClass: "breadcrumb-item" }, [
                    _c("a", { attrs: { href: "javascript: void(0);" } }, [
                      _vm._v("Home"),
                    ]),
                  ]),
                  _vm._v(" "),
                  _c("li", { staticClass: "breadcrumb-item active" }, [
                    _vm._v("profile"),
                  ]),
                ]),
              ]),
            ]
          ),
        ]
      ),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-12" }, [_c("hr")])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-12 d-inline-block mt-2" }, [
      _c(
        "button",
        {
          staticClass:
            "btn btn-info w-lg float-end waves-effect waves-light mt-2",
          attrs: { type: "submit" },
        },
        [_vm._v("Update\n                                    Password")]
      ),
    ])
  },
]
render._withStripped = true



/***/ })

}]);