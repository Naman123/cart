
function _fetch() {
    return function(url, data, options) {
        return new Promise(function(resolve, reject) {
            var request = {
                type: (options && options.method ? options.method : "POST"),
                url: options && options.absolute ? url : (url),
                dataType: ((options && options.dataType) ? options.dataType : 'JSON'),
                data: data,
                success: function(response) {
                    if (response === null) {
                        return resolve(response);
                    }

                    if (response.error) {
                        return reject(response);
                    }

                    return resolve(response);
                },
                error: function(err) {
                    reject(err);
                }
            };

            if (data instanceof FormData) {
                request.processData = false;
                request.contentType = false;
            }

            $.ajax(request);
        });
    }
}

function delayKeyup( fn, delay ) {
  var timer = null;
  return function(e) {
    var self = this;
    timer && clearTimeout(timer);
    timer = setTimeout(function() {
      return fn.call(self, e);
    }, delay || 500);
  }
}

    
