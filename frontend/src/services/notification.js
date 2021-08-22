import swal from 'sweetalert';

export default { 
    successModal(message)
    {
        swal("Success", message, "success");
    },
    errorModal(message)
    {
        swal("Error", message, "error");
    }
}