<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.4/sweetalert2.min.css" integrity="sha512-OWGg8FcHstyYFwtjfkiCoYHW2hG3PDWwdtczPAPUcETobBJOVCouKig8rqED0NMLcT9GtE4jw6IT1CSrwY87uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .box {
            height: 100px;
            width: 90%;
            margin: 10px auto;
            background-color: black;
            border: 2px solid white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box1:nth-child(odd) {
            background-color: red;
            height: 20px;
            width: 20px;
            animation: anim 1s infinite alternate;
        }

        .box1 {
            height: 20px;
            width: 20px;
            border-radius: 50%;
        }

        @keyframes anim {
            0% {
                border-radius: 10%;
                margin-left: -80px;
            }

            100% {
                border-radius: 50%;
                margin-left: 0px;
                background-color: red;
            }
        }

        .showimg {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
            margin: 50px auto;
            background-color: white;
            border-radius: 5px;
            padding: 10px;
        }

        .editimg {
            height: 200px;
            width: auto;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px black;
            transition: all 0.3s;
        }

        .editimg:hover {
            scale: 1.1;
            box-shadow: 0 0 100px black;

        }

        .imglist {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 10px;
        }

        .t {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 50px gray;
        }
    </style>
</head>

<body class="bg-dark">

    <div class="container mt-5 rounded bg-light p-3" id="container">
        <form method="post" enctype="multipart/form-data" class="dropzone rounded bg-info" id="form">
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
                <input type="hidden" name="allimg" id="allimg" value=" ">
                <input type="hidden" name="hid" id="hid" value=" ">
                <input type="hidden" name="folder" id="folder" value=" ">
                <input type="hidden" name="ei" id="ei" value=" ">
            </div>

            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
            </div>
            @csrf
            <div class="mb-3">
                <label for="no" class="form-label">Mo. Number</label>
                <input type="number" class="form-control" id="no" name="no" placeholder="Mo Number">
            </div>

            <label for="no" class="form-label">Status</label>
            <select class="form-select mb-3" name="status" id="status">

                <option value="Active">Active</option>
                <option value="Unactive">Not Active</option>
            </select>

            <div id="dropzoneDragArea" class="dropzone mb-5 rounded">
                <div class="dz-message"><span>Drop files here or click to upload.</span></div>
                <div class="dropzone-previews"></div>
            </div>
            <div class="showimg" id="showimg"></div>
            <button type="submit" class="btn btn-success w-100">Submit</button>
        </form>
    </div>

    <div class="conrtainer bg-light t">
        <table class="table table-striped" id="table">
            <thead>
                <th>No.</th>
                <th> First Name</th>
                <th>Last Name</th>
                <th>Mobile No.</th>
                <th>Status</th>
                <!-- <th>Img</th> -->
                <th>Action</th>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.4/sweetalert2.min.js" integrity="sha512-AXRSg1bk/WYB9XiMgxJJS+jsAuMyS46bL0NZUo0tc2luqTAtDC3zI7UumzsQvFR07j+h2hG37FD9s8RcHTBApA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        Dropzone.autoDiscover = false;
        var uploadedFiles = [];
        $(document).ready(function() {

            $("#form")[0].reset();
            $("#hid").val(" ");
            $("#allimg").val(" ");
            $("#ei").val(" ");
            $("#folder").val(" ");
            $("#showimg").html(" ");
            $("#showimg").hide();

            var uploadedFiles = [];
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };

            $(function() {
                var headers = $('meta[name="csrf-token"]').attr('content');
                var myDropzone = new Dropzone("div#dropzoneDragArea", {
                    paramName: "file",
                    url: "{{route('addimg')}}",
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    maxFileSize: 20,
                    addRemoveLinks: true,
                    uploadMultiple: true,
                    parallelUploads: 10,
                    // maxFiles: 10,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    init: function() {
                        this.on("addedfile", function(file) {
                            uploadedFiles.push(file);
                            return file.name;
                        });

                        this.on("removedfile", function(file) {});

                        this.on('sending', function(file, xhr, formData) {
                            console.log('formData: from dropzone', formData);

                            var ei = $("#ei").val();
                            formData.append('ei', ei);
                        });

                        this.on("successmultiple", function(file, responseText) {
                            var imgval = $("#allimg").val();
                            if (imgval == " ") {
                                $("#allimg").val(responseText[0]);
                            } else {
                                $("#allimg").val(responseText + "," + imgval);
                            }
                            $("#folder").val(responseText[1]);
                        });
                    }
                });
            });

            $("#form").submit(function(e) {
                e.preventDefault();
                var formData = new FormData($("#form")[0]);

                $.ajax({
                    type: "POST",
                    url: "/add",
                    headers: headers,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#table').DataTable().ajax.reload();
                        Swal.fire({
                            title: "Done",
                            text: response.message,
                            icon: "success"
                        });
                        $(".dz-preview").hide();
                        $(".dz-message").show();
                        $("#dropzoneDragArea").on("click", function() {
                            $(".dz-message").hide();
                        })
                        $("#form")[0].reset();
                        $("#hid").val(" ");
                        $("#allimg").val(" ");
                        $("#ei").val(" ");
                        $("#folder").val(" ");
                        $("#showimg").html(" ");
                        $("#showimg").hide();
                    },
                    error: function(error) {}
                });
            });

            let list = $('#table').dataTable({
                searching: true,
                paging: true,
                pageLength: 10,

                "ajax": {
                    url: "/list",
                    type: 'GET',
                    headers: headers,
                    dataType: 'json',
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'fname'
                    },

                    {
                        data: 'lname'
                    },
                    {
                        data: 'no'
                    },
                    {
                        data: 'status',
                        orderable: false
                    },
                    {
                        data: 'action',
                        orderable: false
                    }
                ],
            });

            $(document).on("click", ".delete", function() {
                var dataid = $(this).data("id");
                $.ajax({
                    url: "/del",
                    method: "POST",
                    cache: false,
                    headers: headers,
                    data: {
                        id: dataid,
                    },
                    success: function(responce) {
                        $('#table').DataTable().ajax.reload();
                    }
                })
            });

            $("#showimg").hide();


            $(document).on("click", ".edit", function() {
                var dataid = $(this).data("id");
                // alert(dataid);
                $.ajax({
                    url: "/edit",
                    method: "POST",
                    cache: false,
                    headers: headers,
                    data: {
                        id: dataid
                    },
                    success: function(responce) {
                        var imgdata = responce['imgdata'][0];
                        var imgnameArr = [];

                        for (let i = 0; i < imgdata.length; i++) {
                            imgnameArr.push(imgdata[i].img)
                        }

                        $("#allimg").val(imgnameArr);
                        $("#fname").val(responce['data'][0].fname);
                        $("#lname").val(responce['data'][0].lname);
                        $("#no").val(responce['data'][0].no);
                        $("#status").val(responce['data'][0].status);
                        $("#hid").val(dataid);
                        $("#ei").val(dataid);



                        $("#showimg").show();
                        if (responce['img'][0] == "") {
                            $("#showimg").html("No Image are in our Data");
                        } else {
                            $("#showimg").html(responce['img']);
                        }
                    }
                })
            });

            $(document).on("click", ".imgdel", function() {
                var imgdata = $(this).data("id");

                var imgname = imgdata.substring(imgdata.lastIndexOf('/') + 1);

                $(this).parent(".imglist").hide();
                var allimgval = $("#allimg").val();
                var stringArray = allimgval.split(',');
                var indexToRemove = stringArray.indexOf(imgname);
                if (indexToRemove !== -1) {
                    stringArray.splice(indexToRemove, 1);
                }
                var modifiedString = stringArray.join(',');
                $("#allimg").val(modifiedString);

                $.ajax({
                    url: "/imgdel",
                    method: "POST",
                    cache: false,
                    headers: headers,
                    data: {
                        imgdata: imgdata
                    },
                })
            })
        });
    </script>
</body>

</html>