class emitter {
     static handlers = {};

     static on(eventName, handler) {
          if (!this.handlers[eventName]) this.handlers[eventName] = [];

          this.handlers[eventName].push(handler);
     }

     static off(eventName) {
          if (!this.handlers[eventName]) this.handlers[eventName] = [];

          delete this.handlers[eventName];
     }

     static emit(eventName, ...args) {
          // for (const handler of this.handlers) handler(data);
          for (const key in this.handlers) {
               if (Object.hasOwnProperty.call(this.handlers, key)) {
                    const handles = this.handlers[key];

                    for (const hkey in handles) {
                         if (Object.hasOwnProperty.call(handles, hkey)) {
                              const handle = handles[hkey];
                              if (key == eventName) handle(...args);
                         }
                    }
               }
          }
     }
}

module.exports.emitter = emitter;
