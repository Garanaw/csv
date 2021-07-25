export default class DragAndDrop
{
    constructor(dragArea) {
        this.dragArea = dragArea;
    }

    init() {
        this.getAllEvents().forEach(eventName => {
            this.dragArea.addEventListener(eventName, (event) => {
                event.preventDefault();
                event.stopPropagation();
            }, false)
        });
        this.dragArea.addEventListener('dragenter', event => this.drag(event), false);
        this.dragArea.addEventListener('drop', event => this.drop(event), false);
    }

    drag(event) {
        this.hideError();
    }

    drop(event) {
        const dt = event.dataTransfer;
        const files = dt.files;

        if (this.validate(files[0]) === false) {
            this.showError();
            return;
        }

        this.appendFile(files);
    }

    validate(file) {
        return ['text/csv'].includes(file.type);
    }

    hideError() {
        document.getElementById('error-message').classList.add('hidden');
    }

    showError() {
        document.getElementById('error-message').classList.remove('hidden');
    }

    appendFile(files) {
        this.dragArea.querySelector('#csv-input').files = files;
    }

    getAllEvents() {
        return [
            'dragenter',
            'dragover',
            'dragleave',
            'drop'
        ];
    }
}
