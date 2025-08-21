$(".status-change").change(function(){
  var status = $(this).val();
  var form =  $(this).closest("form");

  if(status == 3) {
  Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, Close it!"
}).then((result) => {
    console.log(result);
  if (result.isConfirmed) {
    form.submit();
  }
});
  }else{
    form.submit();
  }
});