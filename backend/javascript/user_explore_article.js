$(document).ready(function () {
    // at the top of your $(document).ready…
    // Initialize DataTable
    loadexploreArticlesTable();
    var exploreArticles = $.fn.dataTable.isDataTable('#exploreArticlesTable') 
        ? $('#exploreArticlesTable').DataTable() 
        : $('#exploreArticlesTable').DataTable({
            dom: 'Blfrtip',
            buttons: [
                { extend: 'csv',   className: 'd-none' },
                { extend: 'excel', className: 'd-none' },
                { extend: 'print', className: 'd-none' }
            ],
            lengthChange: true,
            lengthMenu: [[10,20,50,100],[10,20,50,100]],
            pageLength: 10,
            ordering: true,
            order: [[0, 'desc']],
            responsive: true,
            language: { paginate: { previous: '<', next: '>' } },
            initComplete: function() {
                $('#exploreArticlesTable_info').appendTo('#infoContainer');
                $('#exploreArticlesTable_length').appendTo('#lengthContainer');
                $('#exploreArticlesTable_paginate').appendTo('#paginateContainer');
            },
            drawCallback: function() {
                $('#exploreArticlesTable_paginate').appendTo('#paginateContainer');
            }
        });
        function renderExploreCards() {
            const container = $('#exploreCardViewArticleContainer');
            container.empty();
            exploreArticles.rows({ search: 'applied' }).data().each(function (rowData) {
            const [article_id, title, contentHTML, author, category, link, status, date, actions] = rowData;
            const plainContent = $('<div>').html(contentHTML).text();
            // … build the same `card` string you already have …
            
            
const card = `
    <a href='page_user_view_explore_article.php?article_id=${article_id}' class="user-view-explore">
        <div class="my-1 py-3 border-bottom">
            <div class="col-12">
                <div>
                    <!-- Top row: category badge + save action -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-brand-500 py-2 px-3 fw-bold fs-6">${category}</span>
                    </div>

                    <!-- Headline -->
                    <h2 class="card-title fw-bold mb-2">
                        ${title}
                    </h2>

                    <!-- Author & date -->
                    <p class='text-muted mb-4'>
                        By <strong>${author}</strong> &nbsp;|&nbsp; ${date}
                    </p>

                    <!-- Featured image with 4:3 aspect ratio -->
                    <div class='aspect-ratio-4-3 mb-4'>
                        <img
                            src="https://images.unsplash.com/photo-1610792472618-8900baee6882"
                            alt='Article image'
                        />
                    </div>

                    <!-- Body text -->
                    <p class="card-text text-muted mb-4 multiline-truncate">
                        ${plainContent}
                    </p>
                </div>
            </div>
        </div>
    </a>`;


            container.append(card);
            });
            // if you want to show a "no results" message:
            if (!container.children().length) {
            container.append('<p class="text-muted">No matching articles</p>');
            }
        }
        
        $('#cardViewBtn').on('click', function () {
            $('#exploreArticlesTable_wrapper').hide();
            $('#listViewBtn').show();
            $(this).hide();
            $('#exploreCardViewArticleContainer').removeClass('d-none');
            renderExploreCards();
        });
    
        exploreArticles.on('search.dt', function () {
            if (!$('#exploreCardViewArticleContainer').hasClass('d-none')) {
            renderExploreCards();
            }
        });

    function loadexploreArticlesTable() {
        $.ajax({
            url: '../backend/phpscripts/admin_article_management.php',
            type: 'GET',
            success: function(data) {
                const adminArticleData = JSON.parse(data);
                
                // Clear and repopulate DataTable
                exploreArticles.clear();
        
                adminArticleData.forEach(article => {
                    let status = '';
                    let statusClass = '';
                    switch (article.status) {
                        case '1':
                            status = 'Pending';
                            statusClass = 'status-yellow';
                            break;
                        case '2':
                            status = 'Approved';
                            statusClass = 'status-active';
                            break;
                        case '3':
                            status = 'Fake';
                            statusClass = 'status-red';
                            break;
                        case '4':
                            status = 'Deleted';
                            statusClass = 'status-inactive';
                            break;
                    }
                    exploreArticles.row.add([
                        article.article_id,
                        article.title,
                        `<div class='multiline-truncate' title='${article.content}'>${article.content}</div>`,
                        article.user_name,
                        article.category_name,
                        `<a href='${article.source_url}' class='link-secondary'>Link</a>`,
                        `<div class='rounded px-2 py-1 ${statusClass} text-center' style='max-width: 90px;'>${status}</div>`,
                        article.created_at,
                        
                        `<a href='#' class='link-warning' onclick='editArticle(${article.article_id})'><i class='fa-solid fa-pen-to-square fs-5'></i></a>
                        <a href='#' class='link-danger' onclick='deleteArticle(${article.article_id})'><i class='fa-solid fa-trash fs-5 mx-2'></i></a>
                        <a href='#' class='link-secondary' onclick=''><i class='fa-solid fa-eye fs-5'></i></a>`
                ]);
            });

            exploreArticles.draw();
            },
            error: function() {
              alert('There was an error retrieving the articles.');
            }
        });
    }
      
      $('#listViewBtn').on('click', function () {
        $(this).hide();
        $('#cardViewBtn').show();
        $('#exploreCardViewArticleContainer').addClass('d-none');
        $('#exploreArticlesTable_wrapper').show();
      });

    $('#categoryForm').on('submit', function(e) {
        e.preventDefault();
        const categoryName = $('#categoryName').val().trim();
      
        if (categoryName === '') {
          alert('Please enter a category name.');
          return;
        }
      
        $.ajax({
          url: '../backend/phpscripts/admin_categories.php',
          type: 'POST',
          data: { categoryName },
          success: function(response) {
            $('#categoryModal').modal('hide');
            $('#categoryForm')[0].reset();
            alert('Category successfully added!');
            loadCategories()
          },
          error: function() {
            alert('There was an error adding the category.');
          }
        });
    });

    // FILTER CHECKBOX DUN SA RIGHT SIDE
    // 2a) Load categories & clone into mobile offcanvas
    $.get("../backend/phpscripts/user_create_article.php", data => {
        const categories = JSON.parse(data);
        const $filters  = $('#exploreCategoryFilters');
        $filters.empty();

        categories.forEach(cat => {
        $filters.append(`
            <div class="form-check">
                <input
                class="form-check-input category-filter"
                type="checkbox"
                data-cat="${cat.category_id}"
                value="${cat.category_name}"
                >
                <label class="form-check-label">
                ${cat.category_name}
                </label>
            </div>
            `);
        });

        // copy into mobile canvas
        $('#exploreCategoryFiltersMobile').html( $filters.html() );
    });

    $(document).on('change', '.category-filter', function() {
    const catId     = $(this).data('cat');
    const isChecked = $(this).prop('checked');

    // 1) Sync all checkboxes with the same data-cat
    $(`.category-filter[data-cat="${catId}"]`)
        .prop('checked', isChecked);

    // 2) Collect all checked values for the filter
    const selected = $('.category-filter:checked')
        .map((_, el) => el.value)
        .get();
    const regex = selected.length ? selected.join('|') : '';

    // 3) Apply to column(4) “Category” and redraw
    exploreArticles
        .column(4)
        .search(regex, true /* regex */, false /* no smart */)
        .draw();
    });

});
