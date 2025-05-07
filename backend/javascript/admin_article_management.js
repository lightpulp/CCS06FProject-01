$(document).ready(function () {
    // at the top of your $(document).ready…
    // Initialize DataTable
    $('#listViewBtn').hide();
    loadAdminArticlesTable();
    var adminArticles = $.fn.dataTable.isDataTable('#adminArticlesTable') 
        ? $('#adminArticlesTable').DataTable() 
        : $('#adminArticlesTable').DataTable({
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
                $('#adminArticlesTable_info').appendTo('#infoContainer');
                $('#adminArticlesTable_length').appendTo('#lengthContainer');
                $('#adminArticlesTable_paginate').appendTo('#paginateContainer');
            },
            drawCallback: function() {
                $('#adminArticlesTable_paginate').appendTo('#paginateContainer');
            }
        });
        function renderCards() {
            const container = $('#adminCardViewArticleContainer');
            container.empty();
            adminArticles.rows({ search: 'applied' }).data().each(function (rowData) {
            const [id, title, contentHTML, author, category, link, status, date, actions] = rowData;
            const plainContent = $('<div>').html(contentHTML).text();
            // … build the same `card` string you already have …
            const card = `
                <div class='article-card'>
                    <div class='card-banner'>
                        <p class='article-category-tag'>${category}</p>
                        <img class='banner-img' src='https://images.unsplash.com/photo-1610792472618-8900baee6882?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' alt=''>
                    </div>
                    <div class='article-card-body'>
                        <h2 class='blog-title'>${title}</h2>
                        <p class='blog-description text-muted multiline-truncate'>${plainContent}</p>
    
                        <div class='article-card-profile'>
                        <img class='profile-img' src='https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cGVyc29ufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60' alt=''>
                        <div class='article-card-profile-info'>
                            <h3 class='profile-name'>${author}</h3>
                            <p class='profile-followers'>Created At: ${date}</p>
                        </div>
                        </div>
    
                        <div class='article-card-status mt-2'>
                        <div class='article-card-profile-info'>
                            <h3 class='profile-name d-inline-block mb-0 me-2'>Status:</h3>
                            <div class='rounded px-3 py-2 text-center d-inline-block'>${status}</div>
                        </div>
                        </div>
                    </div>
                </div>`;
            container.append(card);
            });
            // if you want to show a "no results" message:
            if (!container.children().length) {
            container.append('<p class="text-muted">No matching articles</p>');
            }
        }
        
        $('#cardViewBtn').on('click', function () {
            $('#adminArticlesTable_wrapper').hide();
            $('#listViewBtn').show();
            $(this).hide();
            $('#adminCardViewArticleContainer').removeClass('d-none');
            renderCards();
        });
    
        adminArticles.on('search.dt', function () {
            if (!$('#adminCardViewArticleContainer').hasClass('d-none')) {
            renderCards();
            }
        });
    function loadAdminArticlesTable() {
        $.ajax({
            url: '../backend/phpscripts/admin_article_management.php',
            type: 'GET',
            success: function(data) {
                const adminArticleData = JSON.parse(data);
                
                // Clear and repopulate DataTable
                adminArticles.clear();
        
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
                    adminArticles.row.add([
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

            adminArticles.draw();
            },
            error: function() {
              alert('There was an error retrieving the articles.');
            }
        });
    }
      
      $('#listViewBtn').on('click', function () {
        $(this).hide();
        $('#cardViewBtn').show();
        $('#adminCardViewArticleContainer').addClass('d-none');
        $('#adminArticlesTable_wrapper').show();
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
});
