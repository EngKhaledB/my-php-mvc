<!DOCTYPE html>
<html lang="en" ng-app="ContactModule">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body ng-controller="ContactsCtrl">
<div class="container">
    <div class="row">
        <h1>Contacts!</h1>

        <div class="col-md-8">

            <table class="table table-bordered">
                <tr>
                    <th>Mobile No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th></th>
                </tr>
                <tr ng-show="isLoading">
                    <td colspan="4">Loading ....</td>
                </tr>
                <tr ng-repeat="contact in contacts">
                    <td>{{ contact[1] }}</td>
                    <td>{{ contact[0] }}</td>
                    <td>{{ contact[2] }}</td>
                    <td>
                        <button ng-click="editFn($index)" class="btn btn-default">Edit</button>
                        <button ng-click="deleteFn($index)" class="btn btn-default">Delete</button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-4">
            <form class="form" ng-submit="formDataSubmitFn()">
                <input type="hidden" ng-value="formData.action"/>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" ng-model="formData.name" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">Mobile No</label>
                    <input type="text" ng-disabled="disabledMobileNo" ng-model="formData.mobile_no" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" ng-model="formData.address" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <button type="submit" class="btn btn-default">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    var base_url = '<?= \Helpers\Config::get('base_url') ?>';
</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
<script src="<?= \Helpers\Config::get('base_url') . '/Assets/js/app.js' ?>"></script>

</body>
</html>