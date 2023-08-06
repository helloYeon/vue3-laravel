export default class UploadAdapter {
    constructor(private loader) {
        // The file loader instance to use during the upload.
        this.loader = loader;
    }

    // Starts the upload process.
    upload() {
        return new Promise((resolve, reject) => {
            const reader = new window.FileReader();

            reader.addEventListener("load", () => {
                console.log("ccc");
                console.log("aa2", reader.result);
                resolve({ default: reader.result });
            });

            reader.addEventListener("error", (err) => {
                console.log("ddd");
                reject(err);
            });

            reader.addEventListener("abort", () => {
                reject();
            });

            this.loader.file.then((file) => {
                console.log("aa1", file);

                reader.readAsDataURL(file);
            });
        });
    }

    // Aborts the upload process.
    abort() {
        //
    }
}

export const uploader = function (editor) {
    editor.plugins.get("FileRepository").createUploadAdapter = (loader) =>
        new UploadAdapter(loader);
};
