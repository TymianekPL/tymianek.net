Array.prototype.includesMember = function (arr2) {
     var arr1;
     var includes;
     arr1 = this;
     includes = false;
     arr1.forEach(function (arr1_i) {
          if (arr2.includes(arr1_i)) {
               includes = true;
          }
     });
     return includes;
};

var inherit_array = [];
var inherit;
Array.from(document.styleSheets).forEach(function (styleSheet_i) {
     Array.from(styleSheet_i.cssRules).forEach(function (cssRule_i) {
          if (cssRule_i.type === cssRule_i.IMPORT_RULE) {
               if (cssRule_i.styleSheet != null) {
                    inherit = cssRule_i.styleSheet
                         .getPropertyValue("--inherits")
                         .trim();
               } else {
                    inherit = "";
               }
               if (inherit !== "") {
                    inherit_array.push({
                         selector: cssRule_i.selectorText,
                         inherit: inherit,
                    });
               }
          }
          if (cssRule_i.style != null) {
               inherit = cssRule_i.style.getPropertyValue("--inherits").trim();
          } else {
               inherit = "";
          }
          if (inherit !== "") {
               inherit_array.push({
                    selector: cssRule_i.selectorText,
                    inherit: inherit,
               });
          }
     });
});

Array.from(document.styleSheets).forEach(function (styleSheet_i) {
     Array.from(styleSheet_i.cssRules).forEach(function (cssRule_i) {
          if (cssRule_i.selectorText != null) {
               inherit_array.forEach(function (inherit_i) {
                    if (
                         cssRule_i.selectorText
                              .split(", ")
                              .includesMember(inherit_i.inherit.split(", "))
                    ) {
                         cssRule_i.selectorText =
                              cssRule_i.selectorText +
                              ", " +
                              inherit_i.selector;
                    }
               });
          }
     });
});
