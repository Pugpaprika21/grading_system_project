class Ajax {
  /**
   * 
   * @param {*} url 
   * @param {*} data 
   * @returns 
   */
  static post(url, data) {

    let return_resp = null;

    if (typeof url == 'string') {
      $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: url,
        data: data,
        async: false,
        global: false,
        success: function (response) {
          return_resp = response;
        }, error: function(error) {
          return_resp = error;
        }
      });
    } else {
      return return_resp;
    }
    return return_resp;
  }
  /**
   * 
   * @param {*} url 
   * @param {*} data 
   * @returns 
   */
  static get(url, data) {
    let return_resp = null;
    if (typeof url == 'string') {
      $.ajax({
        type: 'GET',
        dataType: 'JSON',
        url: url,
        data: data,
        async: false,
        global: false,
        success: function (response) {
          return_resp = response;
        }, error: function(error) {
          return_resp = error;
        }
      });
    } else {
      return return_resp;
    }
    return return_resp;
  }
  /**
   * 
   * @param {*} type 
   * @param {*} dataType 
   * @param {*} url 
   * @param {*} data 
   * @returns 
   */
  static ajaxFormData(type, url, data) {
    let return_resp = null;
    $.ajax({
      async: false,
      global: false,
      type: type,
      dataType: 'JSON',
      url: url,
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        return_resp = response;
      },
      error: function (error) {
        return_resp = error;
      },
    });

    return return_resp;
  }
}
