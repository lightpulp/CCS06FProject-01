$(document).ready(function(){
    ////////////////////////////////////////////
    //  START: DATATABLES EXPORT AND SEARCH   //
    ////////////////////////////////////////////

    // custom search
    $('.table-search').on('keyup', function() {
        const tableSelector = $(this).data('table');
        const table = $(tableSelector).DataTable();
        table.search(this.value).draw();
    });

    //////////////////////////////////////////
    //  END: DATATABLES EXPORT AND SEARCH   //
    //////////////////////////////////////////

    $('#fakeKeywordModal').on('shown.bs.modal', function () {
        $('#fakeWord').trigger('focus');
      });

    var keywordTable = $.fn.dataTable.isDataTable('#fakeKeywordTable') 
      ? $('#fakeKeywordTable').DataTable() 
      : $('#fakeKeywordTable').DataTable({
          dom: 'lfrtip',
          lengthChange: true,
          lengthMenu: [[10,20,50,100],[10,20,50,100]],
          pageLength: 10,
          ordering: true,
          order: [[0, 'desc']],
          responsive: true,
          language: { paginate: { previous: '<', next: '>' } },
          initComplete: function() {
              $('#fakeKeywordTable_info').appendTo('#infoContainer');
              $('#fakeKeywordTable_length').appendTo('#lengthContainer');
              $('#fakeKeywordTable_paginate').appendTo('#paginateContainer');
          },
          drawCallback: function() {
              $('#fakeKeywordTable_paginate').appendTo('#paginateContainer');
          }
      });
      
      function loadFakeKeywords() {
        $.ajax({
          url: '../backend/phpscripts/admin_keywords.php',
          type: 'GET',
          success: function (data) {
            const keywords = JSON.parse(data);
            keywordTable.clear();
            keywords.forEach(kw => {
              keywordTable.row.add([
                kw.fword_id,
                kw.fword_word,
                kw.fword_value,
                `<a href='#' class='link-danger' data-id='${kw.fword_id}' id='delete-fakekw-btn'>
                   <i class='fa-solid fa-trash fs-5'></i>
                 </a>`
              ]);
            });
            keywordTable.draw();
          },
          error: () => alert("Failed to load fake keywords.")
        });
      }
      
      loadFakeKeywords();
      
      $('#fakeKeywordForm').on('submit', function (e) {
        e.preventDefault();
        const fakeWord = $('#fakeWord').val().trim();
        const fakeValue = parseInt($('#fakeValue').val());
      
        if (!fakeWord || isNaN(fakeValue)) {
          alert("Please provide both a word and a value (1-5).");
          return;
        }
      
        $.post('../backend/phpscripts/admin_keywords.php', { fakeWord, fakeValue }, function () {
          $('#fakeKeywordModal').modal('hide');
          $('#fakeKeywordForm')[0].reset();
          loadFakeKeywords();
          alert("Fake keyword added.");
        });
      });
      
      $(document).on('click', '#delete-fakekw-btn', function () {
        const id = $(this).data('id');
        if (confirm("Delete this keyword?")) {
          $.ajax({
            url: '../backend/phpscripts/admin_keywords.php',
            type: 'DELETE',
            data: { id },
            success: loadFakeKeywords
          });
        }
      });      
});