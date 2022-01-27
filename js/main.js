$(document).ready(() => {
    $('#db-table').DataTable({"pageLength": 100});
    $('#db-table_length').hide();

    $('.list-group-item').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
});