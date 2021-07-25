import DragAndDrop from "./DragAndDrop";

window.addEventListener('DOMContentLoaded', function () {
    new DragAndDrop(
        document.getElementById('file-upload')
    ).init();
});
