import './bootstrap';

let blurredSection = document.querySelector('.blurred')
let approveModal = document.querySelector('.approve-modal')
let deleteModal = document.querySelector('.delete-modal')

window.handleApproveClick = function() {
    blurredSection.classList.add('blur-sm')
    approveModal.classList.remove('hidden')
}

window.handleDeleteClick = function() {
    blurredSection.classList.add('blur-sm')
    deleteModal.classList.remove('hidden')
}

window.handleApproveModalCancel = function() {
    blurredSection.classList.remove('blur-sm')
    approveModal.classList.add('hidden')
}

window.handleDeleteModalCancel = function() {
    blurredSection.classList.remove('blur-sm')
    deleteModal.classList.add('hidden')
}
