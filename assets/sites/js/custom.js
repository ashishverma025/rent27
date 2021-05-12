
var routeUrl = $('meta[name="route"]').attr('content')

$('#userReview').on('click', function () {
    var name = $("#review_name").val()
    var email = $("#review_email").val()
    var comment = $("#review_comment").val()
    var rating = $("#review_rating").val()
    var truck_id = $("#truck_id").val()

    if (comment == '') {
        alert('Please fill Review');
    }

    $.ajax({
        url: routeUrl + '/saveReview',
        method: 'post',
        data: {
            'name': name,
            'description': comment,
            'email': email,
            'rating': rating,
            'truck_id': truck_id
        },
        beforeSend: function () {
            // Disable the button
            $('#userReview').attr('disabled', true);
            $('#loading_spinner').show();
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        complete: function () {
            // Enable the button
            $('#loading_spinner').hide();
        },
        success: function (response) {
            window.location.reload();
        }
    });
});



$('#userComplaint').on('click', function () {
    var title = $("#complaint_title").val()
    var comment = $("#complaint_description").val()
    var truck_id = $("#truck_id").val()

    if (comment == '') {
        alert('Please fill Complaint Description');
    }

    $.ajax({
        url: routeUrl + '/saveComplaint',
        method: 'post',
        data: {
            'title': title,
            'description': comment,
            'truck_id': truck_id
        },
        beforeSend: function () {
            // Disable the button
            $('#userComplaint').attr('disabled', true);
            $('#loading_spinner').show();
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        complete: function () {
            // Enable the button
            $('#loading_spinner').hide();
        },
        success: function (response) {
            window.location.reload();
        }
    });
});