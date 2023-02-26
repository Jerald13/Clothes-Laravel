

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="favicon.ico">
<title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
<!-- Simple bar CSS -->
<link rel="stylesheet" href="{{ asset('css/simplebar.css') }}">
<!-- Fonts CSS -->
<link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<!-- Icons CSS -->
{{-- {{ asset('{{ asset('css/feather.css') }}') }} --}}
<link rel="stylesheet" href="{{ asset('css/feather.css') }}') }}">
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('css/uppy.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
<link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
<!-- Date Range Picker CSS -->
<link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
<!-- App CSS -->
<link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme" disabled>
<link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme">
</head>
<body class="vertical dark ">
@extends('editor.editorMaster')
@section("content")

<main role="main" class="main-content">
<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-12">
<h2 class="page-title">Form Add Product</h2>
<p class="text-muted">Create product with category</p>
<div class="row" style="justify-content: center;">
<div class="col-md-6" style="width:958px;
max-width: 110%;">
<div class="card shadow mb-4" style="width:958px;
max-width: 110%;">
<div class="card-header">
<strong class="card-title">Default Validation</strong>
</div>
<div class="card-body">
<form class="needs-validation" novalidate>
<div class="form-row">
<div class="col-md-8 mb-3">
<label for="exampleInputEmail1">Email address</label>
<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
<div class="invalid-feedback"> Please use a valid email </div>
<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
</div>
<div class="col-md-4 mb-3">
<label for="validationCustomUsername">Username</label>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="inputGroupPrepend">@</span>
</div>
<input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
<div class="invalid-feedback"> Please choose a username. </div>
</div>
</div>
<div class="col-md-6 mb-3">
<label for="validationCustom01">First name</label>
<input type="text" class="form-control" id="validationCustom01" value="Mark" required>
<div class="valid-feedback"> Looks good! </div>
</div>
<div class="col-md-6 mb-3">
<label for="validationCustom02">Last name</label>
<input type="text" class="form-control" id="validationCustom02" value="Otto" required>
<div class="valid-feedback"> Looks good! </div>
</div>
</div>
<div class="form-row">
<div class="col-md-6 mb-3">
<label for="validationCustom03">City</label>
<input type="text" class="form-control" id="validationCustom03" required>
<div class="invalid-feedback"> Please provide a valid city. </div>
</div>
<div class="col-md-3 mb-3">
<label for="validationCustom04">State</label>
<select class="custom-select" id="validationCustom04" required>
<option selected disabled value="">Choose...</option>
<option>...</option>
</select>
<div class="invalid-feedback"> Please select a valid state. </div>
</div>
<div class="col-md-3 mb-3">
<label for="validationCustom05">Zip</label>
<input type="text" class="form-control" id="validationCustom05" required>
<div class="invalid-feedback"> Please provide a valid zip. </div>
</div>
</div>
<div class="form-group mb-3">
<label for="validationTextarea">About your self</label>
<textarea class="form-control" id="validationTextarea" placeholder="Required example textarea" required></textarea>
<div class="invalid-feedback"> Please enter a message in the textarea. </div>
</div>
<div class="custom-control custom-checkbox mb-3">
<input type="checkbox" class="custom-control-input" id="customControlValidation1" required>
<label class="custom-control-label" for="customControlValidation1">Check this custom checkbox</label>
<div class="invalid-feedback">Example invalid feedback text</div>
</div>
<div class="custom-control custom-radio">
<input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required>
<label class="custom-control-label" for="customControlValidation2">Toggle this custom radio</label>
</div>
<div class="custom-control custom-radio mb-3">
<input type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" required>
<label class="custom-control-label" for="customControlValidation3">Or toggle this other custom radio</label>
<div class="invalid-feedback">More example invalid feedback text</div>
</div>
<div class="form-group mb-4">
<label for="example-multiselect">Select your level</label>
<select id="example-multiselect" multiple="" class="form-control" required>
<option>Level 1</option>
<option>Level 2</option>
<option>Level 3</option>
<option>Level 4</option>
<option>Level 5</option>
</select>
<div class="invalid-feedback">Please select one option</div>
</div>
<div class="custom-file mb-3">
<input type="file" class="custom-file-input" id="validatedCustomFile" required>
<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
<div class="invalid-feedback">Example invalid custom file feedback</div>
</div>
<div class="form-group">
<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
<label class="form-check-label" for="invalidCheck"> Agree to terms and conditions </label>
<div class="invalid-feedback"> You must agree before submitting. </div>
</div>
</div>
<button class="btn btn-primary" type="submit">Submit form</button>
</form>
</div> <!-- /.card-body -->
</div> <!-- /.card -->
</div> <!-- /.col -->

</main> <!-- main -->


</div> <!-- .wrapper -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/simplebar.min.js"></script>
<script src='js/daterangepicker.js'></script>
<script src='js/jquery.stickOnScroll.js'></script>
<script src="js/tinycolor-min.js"></script>
<script src="js/config.js"></script>
<script src='js/jquery.mask.min.js'></script>
<script src='js/select2.min.js'></script>
<script src='js/jquery.steps.min.js'></script>
<script src='js/jquery.validate.min.js'></script>
<script src='js/jquery.timepicker.js'></script>
<script src='js/dropzone.min.js'></script>
<script src='js/uppy.min.js'></script>
<script src='js/quill.min.js'></script>
<script>
$('.select2').select2(
{
theme: 'bootstrap4',
});
$('.select2-multi').select2(
{
multiple: true,
theme: 'bootstrap4',
});
$('.drgpicker').daterangepicker(
{
singleDatePicker: true,
timePicker: false,
showDropdowns: true,
locale:
{
format: 'MM/DD/YYYY'
}
});
$('.time-input').timepicker(
{
'scrollDefault': 'now',
'zindex': '9999' /* fix modal open */
});
/** date range picker */
if ($('.datetimes').length)
{
$('.datetimes').daterangepicker(
{
timePicker: true,
startDate: moment().startOf('hour'),
endDate: moment().startOf('hour').add(32, 'hour'),
locale:
{
format: 'M/DD hh:mm A'
}
});
}
var start = moment().subtract(29, 'days');
var end = moment();

function cb(start, end)
{
$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}
$('#reportrange').daterangepicker(
{
startDate: start,
endDate: end,
ranges:
{
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
}
}, cb);
cb(start, end);
$('.input-placeholder').mask("00/00/0000",
{
placeholder: "__/__/____"
});
$('.input-zip').mask('00000-000',
{
placeholder: "____-___"
});
$('.input-money').mask("#.##0,00",
{
reverse: true
});
$('.input-phoneus').mask('(000) 000-0000');
$('.input-mixed').mask('AAA 000-S0S');
$('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ',
{
translation:
{
'Z':
{
pattern: /[0-9]/,
optional: true
}
},
placeholder: "___.___.___.___"
});
// editor
var editor = document.getElementById('editor');
if (editor)
{
var toolbarOptions = [
[
{
'font': []
}],
[
{
'header': [1, 2, 3, 4, 5, 6, false]
}],
['bold', 'italic', 'underline', 'strike'],
['blockquote', 'code-block'],
[
{
'header': 1
},
{
'header': 2
}],
[
{
'list': 'ordered'
},
{
'list': 'bullet'
}],
[
{
'script': 'sub'
},
{
'script': 'super'
}],
[
{
'indent': '-1'
},
{
'indent': '+1'
}], // outdent/indent
[
{
'direction': 'rtl'
}], // text direction
[
{
'color': []
},
{
'background': []
}], // dropdown with defaults from theme
[
{
'align': []
}],
['clean'] // remove formatting button
];
var quill = new Quill(editor,
{
modules:
{
toolbar: toolbarOptions
},
theme: 'snow'
});
}
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function()
{
'use strict';
window.addEventListener('load', function()
{
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form)
{
form.addEventListener('submit', function(event)
{
if (form.checkValidity() === false)
{
event.preventDefault();
event.stopPropagation();
}
form.classList.add('was-validated');
}, false);
});
}, false);
})();
</script>
<script>
var uptarg = document.getElementById('drag-drop-area');
if (uptarg)
{
var uppy = Uppy.Core().use(Uppy.Dashboard,
{
inline: true,
target: uptarg,
proudlyDisplayPoweredByUppy: false,
theme: 'dark',
width: 770,
height: 210,
plugins: ['Webcam']
}).use(Uppy.Tus,
{
endpoint: 'https://master.tus.io/files/'
});
uppy.on('complete', (result) =>
{
console.log('Upload complete! We’ve uploaded these files:', result.successful)
});
}
</script>
<script src="js/apps.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag()
{
dataLayer.push(arguments);
}
gtag('js', new Date());
gtag('config', 'UA-56159088-1');
</script>


</body>
</html>

@endsection