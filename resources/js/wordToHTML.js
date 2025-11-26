import * as mammoth from 'mammoth/mammoth.browser';

document.addEventListener('livewire:init', () => {
    // Trigger klik input file via Livewire event
    Livewire.on('wordToHTML', () => {
        document.getElementById('importWord').click();

        document.getElementById('importWord').addEventListener('change', async (event) => {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = async function (e) {
                try {
                    toastMagic.info(`Sedang memproses file…<br>${file.name}`);

                    const result = await mammoth.convertToHtml(
                        { arrayBuffer: e.target.result },
                        {
                            convertImage: mammoth.images.inline((element) =>
                                element.read('base64').then((imageBuffer) => ({
                                    src: `data:${element.contentType};base64,${imageBuffer}`,
                                })),
                            ),
                        },
                    );

                    Livewire.dispatch('set-editor-content', {
                        editorId: 'teksBab',
                        content: result.value,
                    });

                    toastMagic.success('Data berhasil diproses dan disimpan!');
                } catch (err) {
                    console.error(err);
                    toastMagic.error('Terjadi kesalahan saat memproses file.');
                }
            };

            reader.readAsArrayBuffer(file);
        });
    });
});
