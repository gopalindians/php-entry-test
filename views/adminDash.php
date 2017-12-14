
<div>

    <div class="row justify-content-md-center" style="display: none" id="user-table">

        <a target="_blank" href="<?= Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ).'allUsers' ?>">See all users
            on map</a>

        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">State</th>
            </tr>
            </thead>
            <tbody id="user_list">
            </tbody>
        </table>
        <div id="load_more_div">
            <button class="btn btn-primary" id="load_more">Load more</button>
        </div>
    </div>
    <div class="row justify-content-md-center" id="admin-main-div"></div>
    <form id="myHiddenForm"
          action="<?= Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) . '/userDetail' ?>"
          method="POST" style="display: none">
        <input type="hidden" name="user_id" value="Hello" id="user_id">
    </form>
</div>


<script>
    $(document).ready(function () {
        var url = $('meta[name=app-url]').attr("content");

        /**
         * Fetch users
         */
        $.ajax({
            url: url + '/api/getUsers',
            success: function (response) {
                if (response.length > 0) {
                    rowCount = response.length;
                    $('#user-table').show();
                    response.forEach(function (value) {
                        $('#user_list').show().append('' +
                            '<tr>' +
                            '<td></td>' +
                            '<td><a onclick="sendToDetail(\'' + value.id + '\')"  id="user_' + value.id + '" href="#" data-user-id="' + value.id + '">' + value.first_name + '</a></td>' +
                            '<td>' + value.last_name + '</td>' +
                            '<td>' + value.state + '</td>' +
                            '</tr>');
                    });
                } else {
                    $('#admin-main-div').html('<h1>No record found</h1>');
                }
            }
        });


        /**
         * Load more Users
         */
        $('#load_more').click(function () {
            $.ajax({
                method: 'POST',
                data: {
                    offset: rowCount
                },
                url: url + '/api/getUsers',
                success: function (response) {
                    rowCount = $('table tr').length + response.length;
                    if (response.length === 0) {
                        $('#load_more_div').html('<i>End of records</i>');
                    } else {
                        response.forEach(function (value) {
                            $('#user_list').append('' +
                                '<tr>' +
                                '<td></td>' +
                                '<td><a  onclick="sendToDetail(\'' + value.id + '\')"  class="user_pop"  id="user_' + value.id + '" href="#">' + value.first_name + '</a></td>' +
                                '<td>' + value.last_name + '</td>' +
                                '<td>' + value.state + '</td>' +
                                '</tr>');
                        });
                    }
                }
            });


        });

    });

    /**
     * Send to User detail page
     * @param user_id
     * @returns {boolean}
     */
    function sendToDetail(user_id) {
        $('#user_id').val(user_id);
        $('#myHiddenForm').submit();
        return false;
    }
</script>