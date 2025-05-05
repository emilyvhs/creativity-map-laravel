import './bootstrap';

let blurredSection = document.querySelector('.blurred')
let approveModal = document.querySelector('.approve-modal')
let deleteModal = document.querySelector('.delete-modal')

//Displays a pop-up asking you to confirm you want to approve the group
window.handleApproveClick = function() {
    blurredSection.classList.add('blur-sm')
    approveModal.classList.remove('hidden')
}

//Displays a pop-up asking you to confirm you want to delete the group
window.handleDeleteClick = function() {
    blurredSection.classList.add('blur-sm')
    deleteModal.classList.remove('hidden')
}

//Closes the approval pop-up without action
window.handleApproveModalCancel = function() {
    blurredSection.classList.remove('blur-sm')
    approveModal.classList.add('hidden')
}

//Closes the cancel pop-up without action
window.handleDeleteModalCancel = function() {
    blurredSection.classList.remove('blur-sm')
    deleteModal.classList.add('hidden')
}
