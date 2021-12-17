{
     const links = document.querySelectorAll("[href]");
     for (const key in links) {
          if (Object.hasOwnProperty.call(links, key)) {
               const element = links[key];
               element.onclick = () => {
                    window.location.href = element.getAttribute("href");
               };
          }
     }
}
