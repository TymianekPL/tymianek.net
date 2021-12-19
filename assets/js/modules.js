const moduleImport = {
     css: (src) => {
          const link = document.createElement("link");
          link.href = src;
          link.rel = "stylesheet";
          document.body.appendChild(link);
     },
     js: (src) => {
          const script = document.createElement("script");
          script.src = src;
          document.body.appendChild(script);
     },
};
