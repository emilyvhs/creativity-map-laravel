import './bootstrap';

let blurredSection = document.querySelector('.blurred')
let approveModal = document.querySelector('.approve-modal')
let deleteModalPendingGroup = document.querySelector('.delete-modal-pending-group')
let deleteExistingGroupButton = document.querySelector('.delete-button')
let deleteConfirmationButtons = document.querySelector('.delete-confirmation-buttons')


//Displays a pop-up asking you to confirm you want to approve the group
window.handleApproveClick = function() {
    blurredSection.classList.add('blur-sm')
    approveModal.classList.remove('hidden')
}

//Displays a pop-up asking you to confirm you want to delete a pending group
window.handleDeletePendingGroupClick = function() {
    blurredSection.classList.add('blur-sm')
    deleteModalPendingGroup.classList.remove('hidden')
}

//Displays confirmation buttons asking you to confirm you want to delete an existing group
window.handleDeleteExistingGroupClick = function() {
    deleteExistingGroupButton.classList.add('hidden')
    deleteConfirmationButtons.classList.remove('hidden')
}

//Closes the approval pop-up without action
window.handleApproveModalCancel = function() {
    blurredSection.classList.remove('blur-sm')
    approveModal.classList.add('hidden')
}

//Closes the delete pending group pop-up without action
window.handleDeleteModalPendingGroupCancel = function() {
    blurredSection.classList.remove('blur-sm')
    deleteModalPendingGroup.classList.add('hidden')
}

//Closes delete existing group confirmation buttons
window.handleDeleteExistingGroupCancel = function() {
    deleteExistingGroupButton.classList.remove('hidden')
    deleteConfirmationButtons.classList.add('hidden')
}
