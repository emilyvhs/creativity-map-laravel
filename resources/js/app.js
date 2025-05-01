import './bootstrap';

let blurredSection = document.querySelector('.blurred')
let approveModal = document.querySelector('.approve-modal')

window.handleApproveClick = function() {
    blurredSection.classList.add('blur-sm')
    approveModal.classList.remove('hidden')
}

window.handleApproveModalCancel = function() {
    blurredSection.classList.remove('blur-sm')
    approveModal.classList.add('hidden')
}
