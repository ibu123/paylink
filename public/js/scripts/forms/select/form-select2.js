/*=========================================================================================
    File Name: form-select2.js
    Description: Select2 is a jQuery-based replacement for select boxes.
    It supports searching, remote data sets, and pagination of results.
    ----------------------------------------------------------------------------------------
    Item Name: Frest HTML Admin Template
    Version: 1.0
    Author: Pixinvent
    Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function(window, document, $) {
	'use strict';

  // Basic Select2 select
	$(".select2").select2({
    // the following code is used to disable x-scrollbar when click in select input and
    // take 100% width in responsive also
    dropdownAutoWidth: true,
    width: '100%'
  });

  // Select With Icon
  $(".select2-icons").select2({
      dropdownAutoWidth: true,
      width: '100%',
      minimumResultsForSearch: Infinity,
      templateResult: iconFormat,
      templateSelection: iconFormat2,
      escapeMarkup: function(es) { return es; }
  });

  // Format icon
  function iconFormat(icon) {
      var originalOption = icon.element;
    //   if (!icon.id) { return icon.text; }

      var color = $(icon.element).data("icon");

      var fontColor = $(icon.element).data("font-color");
      var $icon = $(
        '<span class="option__badge" style="background :'+color+';color:'+fontColor+' !important; padding-right:12px !important" >' +icon.text + '</span>'

    );

      return $icon;
  }

  function iconFormat2(icon){
    var originalOption = icon.element;
    //   if (!icon.id) { return icon.text; }

      var color = $(icon.element).data("icon");
      var fontColor = $(icon.element).data("font-color");

      var $icon = $(
        '<span class="option__badge" style="background :'+color+';color:'+fontColor+' !important; " >' +icon.text + '</span>'

    );

      return $icon;
  }
  // Limiting the number of selections
  $(".max-length").select2({
    dropdownAutoWidth: true,
    width: '100%',
    maximumSelectionLength: 2,
    placeholder: "Select maximum 2 items"
  });


  // Programmatic access
  var $select = $(".js-example-programmatic").select2({
    dropdownAutoWidth: true,
    width: '100%'
  });
  var $selectMulti = $(".js-example-programmatic-multi").select2();
  $selectMulti.select2({
    dropdownAutoWidth: true,
    width: '100%',
    placeholder: "Programmatic Events"
  });
  $(".js-programmatic-set-val").on("click", function () { $select.val("CA").trigger("change"); });

  $(".js-programmatic-open").on("click", function () { $select.select2("open"); });
  $(".js-programmatic-close").on("click", function () { $select.select2("close"); });

  $(".js-programmatic-init").on("click", function () { $select.select2(); });
  $(".js-programmatic-destroy").on("click", function () { $select.select2("destroy"); });

  $(".js-programmatic-multi-set-val").on("click", function () { $selectMulti.val(["CA", "AL"]).trigger("change"); });
  $(".js-programmatic-multi-clear").on("click", function () { $selectMulti.val(null).trigger("change"); });

  // Loading array data
  var data = [
      { id: 0, text: 'enhancement' },
      { id: 1, text: 'bug' },
      { id: 2, text: 'duplicate' },
      { id: 3, text: 'invalid' },
      { id: 4, text: 'wontfix' }
  ];

  $(".select2-data-array").select2({
    dropdownAutoWidth: true,
    width: '100%',
    data: data
  });

  var __cache = [];
  $(".select2-ajax").select2({

    dropdownAutoWidth: true,
    width:'100%',
    ajax: {
        url: window.merchantListURL,
        dataType: 'json',
        delay: 250,
        width: '100%',
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page
          };
        },
        transport :  function (params, success, failure) {
            var __cachekey = params.data.q || '_ALL_';
            if ('undefined' !== typeof __cache[__cachekey]) {
            //display the cached results
            success(__cache[__cachekey]);
                return; /* noop */
            }
            var $request = $.ajax(params);
            $request.then(function(data) {
                //store data in cache
                __cache[__cachekey] = data;
                //display the results
                success(__cache[__cachekey]);
            });
            $request.fail(failure);
            return $request;
        },
        processResults: function (data, params) {
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          params.page = params.page || 1;

          return {
            results: data.items,
            pagination: {
              more: (params.page * 30) < data.total_count
            }
          };
        },
        cache: true
      },
      placeholder: 'Search for a repository',
      escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
      minimumInputLength: 0,
      templateResult: (data) => {
        return data.store_display_name;
      },
      templateSelection: (data) => {
        return data.store_display_name;
      }

  })

  var __cache__2 = [];
  $(".select2-ajax-paylink").select2({

    dropdownAutoWidth: true,
    width:'100%',
    ajax: {
        url: window.paylinkListURL,
        dataType: 'json',
        delay: 250,
        width: '100%',
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page
          };
        },
        transport :  function (params, success, failure) {

            var __cachekey = params.data.q || '_ALL_';
            // console.log(params.data.page);
            // if(__cache__2[__cachekey] && __cache__2[__cachekey]["pages"]) {
            //   console.log(__cache__2[__cachekey]["pages"])

            // }
            if(!params.data.page) {
                params.data.page = 1;
            }
            if (__cache__2[__cachekey]  && (!params.data.page || params.data.page <= __cache__2[__cachekey]["pages"]) ) {
            //display the cached results

                let abc = JSON.parse(JSON.stringify(__cache__2[__cachekey]));

                abc.items = abc.items.slice(
                    (params.data.page - 1) * 8 , 8 * params.data.page
                )
                success(abc);
                return; /* noop */
            }
            var $request = $.ajax(params);
            $request.then(function(data) {
                //store data in cache
                if(__cache__2[__cachekey]) {
                    __cache__2[__cachekey].items = __cache__2[__cachekey].items.concat(data.items);
                } else {
                  __cache__2[__cachekey] = data;
                }

                __cache__2[__cachekey]["pages"] = data.page;
                // console.log(__cache__2[__cachekey]);
                //display the results
                // let temp = [];
                // temp[__cachekey] = data;
                // temp[__cachekey]["pages"] = data.page;

                let abc = JSON.parse(JSON.stringify(__cache__2[__cachekey]));

                abc.items = abc.items.slice(
                    (data.page - 1) * 8 , abc.items.length
                )
                success( abc);
            });
            $request.fail(failure);
            return $request;
        },
        processResults: function (data, params) {
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          params.page = params.page || 1;
        // alert(data.total_count);
          return {
            results: data.items,
            pagination: {
              more: params.page < data.total_count
            }
          };
        },
      },
      placeholder: 'Search for a repository',
      escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
      minimumInputLength: 0,
      templateResult: (data) => {
        return `<div class="text-dark" style="padding-right:10px;font-family:brando-light">${data.id + " - " + data?.paylink_invoice?.id}</div>`;
      },
      templateSelection: (data) => {
        return `<div class="text-dark" style="padding-right:10px;font-family:brando-light">${data.id + " - " + data?.paylink_invoice?.id}</div>`;
      }

  }).data('select2').$container.addClass('select2__ajax__list');
  // Loading remote data
  $(".select2-data-ajax").select2({
      dropdownAutoWidth: true,
      width: '100%',
      ajax: {
      url: "https://api.github.com/search/repositories",
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used
        params.page = params.page || 1;

        return {
          results: data.items,
          pagination: {
            more: (params.page * 30) < data.total_count
          }
        };
      },
      cache: true
    },
    placeholder: 'Search for a repository',
    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
  });

  function formatRepo (repo) {
    if (repo.loading) return repo.text;

    var markup = "<div class='select2-result-repository clearfix'>" +
      "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
      "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

    if (repo.description) {
      markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
    }

    markup += "<div class='select2-result-repository__statistics'>" +
      "<div class='select2-result-repository__forks'><i class='icon-code-fork mr-0'></i> " + repo.forks_count + " Forks</div>" +
      "<div class='select2-result-repository__stargazers'><i class='icon-star5 mr-0'></i> " + repo.stargazers_count + " Stars</div>" +
      "<div class='select2-result-repository__watchers'><i class='icon-eye mr-0'></i> " + repo.watchers_count + " Watchers</div>" +
    "</div>" +
    "</div></div>";

    return markup;
  }

  function formatRepoSelection (repo) {
    return repo.full_name || repo.text;
  }


  // Customizing how results are matched
  function matchStart (term, text) {
    if (text.toUpperCase().indexOf(term.toUpperCase()) === 0) {
      return true;
    }

    return false;
  }

  $.fn.select2.amd.require(['select2/compat/matcher'], function (oldMatcher) {
    $(".select2-customize-result").select2({
      dropdownAutoWidth: true,
      width: '100%',
      placeholder: "Search by 'r'",
      matcher: oldMatcher(matchStart)
    });
  });

  // Theme support
  $(".select2-theme").select2({
    dropdownAutoWidth: true,
    width: '100%',
    placeholder: "Classic Theme",
    theme: "classic"
  });

  /******************/
  // Sizing options //
  /*****************/

  // Large
  $('.select2-size-lg').select2({
    dropdownAutoWidth: true,
    width: '100%',
    containerCssClass: 'select-lg'
  });

  // Small
  $('.select2-size-sm').select2({
    dropdownAutoWidth: true,
    width: '100%',
    containerCssClass: 'select-sm'
  });

})(window, document, jQuery);
