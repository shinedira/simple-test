<template>
    <div id="file-drag-drop">
        <div class="drag-container">
            <input type="file" name="file" id="file" @change="onChange" ref="file" hidden />

            <label for="file" class="bg-white w-100" @dragover="dragover" @dragleave="dragleave" @drop="drop">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="p-3" v-if="!file.name">
                        Drop file here
                        or <u>click here</u> to upload file
                    </div>
                    <div class="media-body p-3" v-else>
                        <h5 class="mt-0 mb-1">{{ filename }}</h5>
                        <a class="btn btn-danger" role="button" v-on:click="remove">Remove</a>
                    </div>
                </div>

            </label>

            <!-- <ul class="mt-4" v-if="this.filelist.length" v-cloak>
                <li class="text-sm p-1" v-for="file in filelist" :key="file">
                    ${ file.name }<button class="ml-2" type="button" @click="remove(filelist.indexOf(file))"
                        title="Remove file">remove</button>
                </li>
            </ul> -->
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                file: {},
                filename: '',
                filelist: []
            }
        },
        methods: {
            onChange() {
                this.file = this.$refs.file.files[0];
                this.filename = this.file.name;
            },
            remove() {
                this.filename = '';
                this.file = {};
            },
            dragover(event) {
                event.preventDefault();
                if (!event.currentTarget.classList.contains('bg-info')) {
                    event.currentTarget.classList.remove('bg-white');
                    event.currentTarget.classList.add('bg-info');
                }
            },
            dragleave(event) {
                // Clean up
                event.currentTarget.classList.add('bg-white');
                event.currentTarget.classList.remove('bg-info');
            },
            drop(event) {
                event.preventDefault();
                this.$refs.file.files = event.dataTransfer.files;
                this.onChange(); // Trigger the onChange event manually
                // Clean up
                this.dragleave(event);
            }
        }
    }

</script>

<style scoped>
    /* #wrapper {
  margin:0 auto;
}
#fileDropBox {
  line-height: 13em;
  border: 3px dashed #1fab89;
  text-align: center;
  color: #1fab89;
  border-radius: 7px;
} */
    .drag-container {
        height: 100px;
    }
    label {
        /* line-height: 8em; */
        height: 8em;
        border: 3px dashed #304ffe;
        /* width: 500%; */
        text-align: center;
        color: #0026ca;
        border-radius: 7px;
    }

    /* div.file-listing {
        width: 400px;
        margin: auto;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    div.file-listing img {
        height: 100px;
    }

    div.remove-container {
        text-align: center;
    }

    div.remove-container a {
        color: red;
        cursor: pointer;
    }

    a.submit-button {
        display: block;
        margin: auto;
        text-align: center;
        width: 200px;
        padding: 10px;
        text-transform: uppercase;
        background-color: #CCC;
        color: white;
        font-weight: bold;
        margin-top: 20px;
    }

    progress {
        width: 400px;
        margin: auto;
        display: block;
        margin-top: 20px;
        margin-bottom: 20px;
    } */

</style>
