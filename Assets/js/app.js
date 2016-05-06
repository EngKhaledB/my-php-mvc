var app = angular.module('ContactModule', []);

app.factory('ContactsApi', ['$http', function ($http) {
    return {
        getContacts: function () {
            return $http.get(base_url + 'contacts');
        },
        deleteContact: function (mobile_no) {
            return $http.delete(base_url + 'contacts/' + mobile_no);
        },
        createContact: function (data) {
            return $http.post(base_url + 'contacts/', data);
        },
        updateContact: function (data) {
            return $http.put(base_url + 'contacts/', data);
        }
    }
}
]);

app.controller('ContactsCtrl', function ($scope, $http, ContactsApi) {

    $scope.contacts = [];
    $scope.isLoading = true;
    $scope.formData = {};
    $scope.formData.action = 'post';
    $scope.disabledMobileNo = false;
    $scope.currentEditingIndex = 0;

    $scope.formDataSubmitFn = function () {

        if ($scope.formData.action !== undefined && $scope.formData.action !== ''
            && $scope.formData.name !== undefined && $scope.formData.name !== ''
            && $scope.formData.mobile_no !== undefined && $scope.formData.mobile_no !== ''
            && $scope.formData.address !== undefined && $scope.formData.address !== '') {

            var frmData = angular.copy($scope.formData);

            if ($scope.formData.action == 'post') {
                delete  frmData.action;
                ContactsApi.createContact(frmData).success(function (data) {
                    $scope.contacts.push(data);
                    $scope.cancelFn();
                    alert('Contact Created!');
                }).error(function (data, status) {
                    if(status == 409)
                        alert('Mobile Number Exists Before!');
                    else
                        alert('Request Invalid!');
                });
            } else {
                ContactsApi.updateContact(frmData).success(function (data) {
                    delete  frmData.action;
                    $scope.contacts[$scope.currentEditingIndex] = data;
                    $scope.cancelFn();
                    alert('Contact Updated!');
                }).error(function (data, status) {
                    if(status == 404)
                        alert('Contact Not found!');
                    else
                        alert('Request Invalid!');
                });
            }
        } else {
            alert('All Fields Required!');
        }

    };

    $scope.deleteFn = function (index) {
        var mobileNo = $scope.contacts[index][1];
        ContactsApi.deleteContact(mobileNo).success(function (data) {
            $scope.contacts.splice(index, 1);
            alert('Contact Deleted!');
        }).error(function (data, status) {
            if(status == 404)
                alert('Contact Not found!');
            else
                alert('Request Invalid!');
        });
    };
    $scope.editFn = function (index) {
        var data = $scope.contacts[index];
        $scope.formData.name = data[0];
        $scope.formData.mobile_no = data[1];
        $scope.formData.address = data[2];
        $scope.formData.action = 'put';
        $scope.disabledMobileNo = true;
        $scope.currentEditingIndex = index;
    };
    $scope.cancelFn = function () {
        $scope.formData = {};
        $scope.action = 'post';
        $scope.disabledMobileNo = false;
        $scope.currentEditingIndex = 0;

    };

    function init() {
        ContactsApi.getContacts().success(function (data) {
            $scope.contacts = data;
            $scope.isLoading = false;
        });
    }

    init();

});