setInterval(() => {
     const links = document.querySelectorAll("[href]");
     for (const key in links) {
          if (Object.hasOwnProperty.call(links, key)) {
               const element = links[key];
               element.title = element.getAttribute("href");
               if (element.onclick == null) {
                    element.onclick = () => {
                         window.location.href = element.getAttribute("href");
                         return true;
                    };
               }
          }
     }
}, 1000);

// const script = document.createElement("script");
// script.src = "/assets/js/css.js";
// document.body.appendChild(script);
