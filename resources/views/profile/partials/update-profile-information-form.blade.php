<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('profile.profile_information.title') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('profile.profile_information.description') }}
        </p>
    </header>

    {{-- Email Verification --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form
        method="post"
        action="{{ route('profile.update') }}"
        enctype="multipart/form-data"
        class="mt-6 space-y-8"
    >
        @csrf
        @method('patch')

        {{-- ===================================================== --}}
        {{-- PROFILE PHOTO --}}
        {{-- ===================================================== --}}

        <div>
            <x-input-label
                for="profile_photo"
                :value="__('profile.profile_information.photo')"
            />

            <div class="mt-4 flex flex-col sm:flex-row sm:items-center gap-5">

                {{-- Current Photo / Preview --}}
                <div class="flex-shrink-0">

                    @if ($user->profile_photo_path)

                        <img
                            id="profile-photo-preview"
                            src="{{ asset('storage/' . $user->profile_photo_path) }}"
                            alt="{{ $user->name }}"
                            class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-md ring-2 ring-indigo-100"
                        >

                    @else

                        <div
                            id="profile-photo-placeholder"
                            class="h-24 w-24 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-3xl font-bold border-4 border-white shadow-md ring-2 ring-indigo-100"
                        >
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <img
                            id="profile-photo-preview"
                            src=""
                            alt="{{ $user->name }}"
                            class="hidden h-24 w-24 rounded-full object-cover border-4 border-white shadow-md ring-2 ring-indigo-100"
                        >

                    @endif

                </div>


                {{-- Upload Controls --}}
                <div class="flex-1">

                    <label
                        for="profile_photo"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-indigo-700 cursor-pointer transition"
                    >
                        {{ __('profile.profile_information.choose_new_photo') }}
                    </label>

                    <input
                        id="profile_photo"
                        name="profile_photo"
                        type="file"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        class="hidden"
                    >

                    {{-- Selected File Name --}}
                    <p
                        id="profile-photo-name"
                        class="mt-2 text-sm text-gray-600 hidden"
                    ></p>

                    <p class="mt-2 text-xs text-gray-500">
                        {{ __('profile.profile_information.file_requirements') }}
                    </p>

                    <x-input-error
                        class="mt-2"
                        :messages="$errors->get('profile_photo')"
                    />

                    {{-- Remove Photo --}}
                    @if ($user->profile_photo_path)

                        <label class="mt-4 inline-flex items-center gap-2 cursor-pointer">

                            <input
                                type="checkbox"
                                name="remove_profile_photo"
                                value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            >

                            <span class="text-sm text-gray-600">
                                {{ __('profile.profile_information.remove_current_photo') }}
                            </span>

                        </label>

                    @endif

                </div>

            </div>
        </div>


        {{-- ===================================================== --}}
        {{-- NAME --}}
        {{-- ===================================================== --}}

        <div>

            <x-input-label
                for="name"
                :value="__('profile.profile_information.name')"
            />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />

        </div>


        {{-- ===================================================== --}}
        {{-- EMAIL --}}
        {{-- ===================================================== --}}

        <div>

            <x-input-label
                for="email"
                :value="__('profile.profile_information.email')"
            />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />

            {{-- Email Verification --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div>

                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('profile.profile_information.email_unverified') }}

                        <button
                            form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            {{ __('profile.profile_information.resend_verification') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')

                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('profile.profile_information.verification_sent') }}
                        </p>

                    @endif

                </div>

            @endif

        </div>


        {{-- ===================================================== --}}
        {{-- SAVE --}}
        {{-- ===================================================== --}}

        <div class="flex items-center gap-4">

            <x-primary-button>
                {{ __('profile.profile_information.save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
                    {{ __('profile.profile_information.saved') }}
                </p>

            @endif

        </div>

    </form>


    {{-- ========================================================= --}}
    {{-- CROP PROFILE PHOTO MODAL --}}
    {{-- ========================================================= --}}

    <div
        id="photo-crop-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm px-4 py-6"
    >

        <div
            class="w-full max-w-xl overflow-hidden rounded-2xl bg-white shadow-2xl"
        >

            {{-- Modal Header --}}
            <div class="flex items-start justify-between border-b border-gray-200 px-6 py-5">

                <div>
                    <h3 class="text-xl font-semibold text-gray-900">
                        {{ __('profile.crop.title') }}
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ __('profile.crop.description') }}
                    </p>
                </div>

                <button
                    type="button"
                    id="crop-close-button"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-700 transition"
                    aria-label="{{ __('Close') }}"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>

            </div>


            {{-- ================================================= --}}
            {{-- CROP AREA --}}
            {{-- ================================================= --}}

            <div class="bg-gray-900 px-6 py-7">

                <div
                    id="crop-stage"
                    class="relative mx-auto h-[360px] w-[360px] max-w-full overflow-hidden rounded-xl bg-gray-950 shadow-inner cursor-grab active:cursor-grabbing touch-none select-none"
                >

                    <canvas
                        id="crop-canvas"
                        width="360"
                        height="360"
                        class="block h-full w-full"
                    ></canvas>


                    {{-- Dark Overlay + Circular Crop Area --}}
                    <div
                        class="pointer-events-none absolute inset-0 flex items-center justify-center"
                    >

                        <div
                            class="h-[290px] w-[290px] rounded-full border-[3px] border-white shadow-[0_0_0_9999px_rgba(0,0,0,0.58)]"
                        ></div>

                    </div>


                    {{-- Drag Hint --}}
                    <div
                        id="crop-drag-hint"
                        class="pointer-events-none absolute bottom-5 left-1/2 -translate-x-1/2 rounded-full bg-black/60 px-4 py-2 text-xs font-medium text-white backdrop-blur-sm"
                    >
                        {{ __('Drag to reposition') }}
                    </div>

                </div>


                {{-- Zoom Controls --}}
                <div class="mx-auto mt-7 flex max-w-sm items-center gap-4">

                    <button
                        type="button"
                        id="zoom-out-button"
                        class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-white/10 text-lg font-medium text-white hover:bg-white/20 transition"
                        aria-label="{{ __('profile.crop.zoom_out') }}"
                    >
                        −
                    </button>

                    <input
                        id="crop-zoom"
                        type="range"
                        min="1"
                        max="3"
                        step="0.01"
                        value="1"
                        class="w-full cursor-pointer accent-indigo-500"
                        aria-label="{{ __('Zoom') }}"
                    >

                    <button
                        type="button"
                        id="zoom-in-button"
                        class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-white/10 text-lg font-medium text-white hover:bg-white/20 transition"
                        aria-label="{{ __('profile.crop.zoom_in') }}"
                    >
                        +
                    </button>

                </div>

                <div class="mt-2 text-center text-xs text-gray-400">
                    {{ __('Zoom') }}
                </div>

            </div>


            {{-- ================================================= --}}
            {{-- ACTIONS --}}
            {{-- ================================================= --}}

            <div class="flex items-center justify-end gap-3 border-t border-gray-200 bg-white px-6 py-4">

                <button
                    type="button"
                    id="crop-cancel-button"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50"
                >
                    {{ __('profile.crop.cancel') }}
                </button>

                <button
                    type="button"
                    id="crop-apply-button"
                    class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                >
                    {{ __('profile.crop.crop_and_use') }}
                    <span class="ml-2">→</span>
                </button>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- CROP SCRIPT --}}
    {{-- ========================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const input = document.getElementById('profile_photo');
            const preview = document.getElementById('profile-photo-preview');
            const placeholder = document.getElementById('profile-photo-placeholder');
            const fileName = document.getElementById('profile-photo-name');

            const modal = document.getElementById('photo-crop-modal');
            const stage = document.getElementById('crop-stage');
            const canvas = document.getElementById('crop-canvas');

            const zoomSlider = document.getElementById('crop-zoom');
            const zoomOutButton = document.getElementById('zoom-out-button');
            const zoomInButton = document.getElementById('zoom-in-button');

            const closeButton = document.getElementById('crop-close-button');
            const cancelButton = document.getElementById('crop-cancel-button');
            const applyButton = document.getElementById('crop-apply-button');

            const dragHint = document.getElementById('crop-drag-hint');

            if (!input || !preview || !modal || !stage || !canvas) {
                return;
            }


            /* =====================================================
             * CANVAS SETTINGS
             * ===================================================== */

            const ctx = canvas.getContext('2d');

            const canvasSize = 360;
            const cropSize = 290;

            let image = new Image();

            let scale = 1;
            let baseScale = 1;

            let imageX = 0;
            let imageY = 0;

            let pointerStartX = 0;
            let pointerStartY = 0;

            let startImageX = 0;
            let startImageY = 0;

            let isDragging = false;

            let currentFile = null;


            /* =====================================================
             * OPEN CROP MODAL
             * ===================================================== */

            function openCropModal(file) {

                currentFile = file;

                const objectUrl = URL.createObjectURL(file);

                image = new Image();

                image.onload = function () {

                    const imageWidth = image.naturalWidth;
                    const imageHeight = image.naturalHeight;

                    /*
                     * The image must always cover
                     * the entire circular crop area.
                     */
                    baseScale = Math.max(
                        cropSize / imageWidth,
                        cropSize / imageHeight
                    );

                    scale = baseScale;

                    /*
                     * Center image.
                     */
                    imageX = (
                        canvasSize -
                        imageWidth * scale
                    ) / 2;

                    imageY = (
                        canvasSize -
                        imageHeight * scale
                    ) / 2;

                    zoomSlider.value = 1;

                    drawCanvas();

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    /*
                     * Show drag hint briefly.
                     */
                    dragHint.classList.remove('opacity-0');

                    setTimeout(function () {
                        dragHint.classList.add('opacity-0');
                    }, 2500);

                    URL.revokeObjectURL(objectUrl);
                };

                image.src = objectUrl;
            }


            /* =====================================================
             * DRAW IMAGE
             * ===================================================== */

            function drawCanvas() {

                ctx.clearRect(
                    0,
                    0,
                    canvasSize,
                    canvasSize
                );

                /*
                 * Background.
                 */
                ctx.fillStyle = '#030712';

                ctx.fillRect(
                    0,
                    0,
                    canvasSize,
                    canvasSize
                );


                const width =
                    image.naturalWidth * scale;

                const height =
                    image.naturalHeight * scale;


                /*
                 * Draw image.
                 */
                ctx.drawImage(
                    image,
                    imageX,
                    imageY,
                    width,
                    height
                );
            }


            /* =====================================================
             * KEEP IMAGE INSIDE CROP AREA
             * ===================================================== */

            function clampImagePosition() {

                const width =
                    image.naturalWidth * scale;

                const height =
                    image.naturalHeight * scale;


                /*
                 * The crop circle is centered.
                 */
                const cropLeft =
                    (canvasSize - cropSize) / 2;

                const cropTop =
                    (canvasSize - cropSize) / 2;

                const cropRight =
                    cropLeft + cropSize;

                const cropBottom =
                    cropTop + cropSize;


                /*
                 * Image must completely cover
                 * the crop square.
                 */
                const minX =
                    cropRight - width;

                const maxX =
                    cropLeft;

                const minY =
                    cropBottom - height;

                const maxY =
                    cropTop;


                imageX = Math.min(
                    maxX,
                    Math.max(minX, imageX)
                );

                imageY = Math.min(
                    maxY,
                    Math.max(minY, imageY)
                );
            }


            /* =====================================================
             * ZOOM
             * ===================================================== */

            function setZoom(value) {

                const newZoom = Math.min(
                    3,
                    Math.max(1, parseFloat(value))
                );

                /*
                 * Keep the center of the crop area
                 * stable while zooming.
                 */
                const cropCenterX = canvasSize / 2;
                const cropCenterY = canvasSize / 2;

                const oldScale = scale;

                scale = baseScale * newZoom;

                const scaleRatio =
                    scale / oldScale;

                imageX =
                    cropCenterX -
                    (
                        cropCenterX - imageX
                    ) * scaleRatio;

                imageY =
                    cropCenterY -
                    (
                        cropCenterY - imageY
                    ) * scaleRatio;


                clampImagePosition();

                zoomSlider.value = newZoom;

                drawCanvas();
            }


            zoomSlider.addEventListener(
                'input',
                function () {
                    setZoom(this.value);
                }
            );


            zoomOutButton.addEventListener(
                'click',
                function () {

                    const current =
                        parseFloat(zoomSlider.value);

                    setZoom(
                        Math.max(
                            1,
                            current - 0.1
                        )
                    );
                }
            );


            zoomInButton.addEventListener(
                'click',
                function () {

                    const current =
                        parseFloat(zoomSlider.value);

                    setZoom(
                        Math.min(
                            3,
                            current + 0.1
                        )
                    );
                }
            );


            /* =====================================================
             * POINTER POSITION
             * ===================================================== */

            function getPointerPosition(event) {

                const rect =
                    stage.getBoundingClientRect();

                return {
                    x:
                        event.clientX -
                        rect.left,

                    y:
                        event.clientY -
                        rect.top
                };
            }


            /* =====================================================
             * START DRAGGING
             * ===================================================== */

            stage.addEventListener(
                'pointerdown',
                function (event) {

                    event.preventDefault();

                    /*
                     * Only primary mouse button.
                     */
                    if (
                        event.pointerType === 'mouse' &&
                        event.button !== 0
                    ) {
                        return;
                    }

                    const position =
                        getPointerPosition(event);

                    isDragging = true;

                    pointerStartX =
                        position.x;

                    pointerStartY =
                        position.y;

                    startImageX =
                        imageX;

                    startImageY =
                        imageY;


                    stage.setPointerCapture(
                        event.pointerId
                    );


                    /*
                     * Change cursor.
                     */
                    stage.classList.remove(
                        'cursor-grab'
                    );

                    stage.classList.add(
                        'cursor-grabbing'
                    );


                    /*
                     * Hide hint.
                     */
                    dragHint.classList.add(
                        'opacity-0'
                    );
                }
            );


            /* =====================================================
             * MOVE IMAGE
             * ===================================================== */

            stage.addEventListener(
                'pointermove',
                function (event) {

                    if (!isDragging) {
                        return;
                    }

                    event.preventDefault();

                    const position =
                        getPointerPosition(event);

                    const deltaX =
                        position.x -
                        pointerStartX;

                    const deltaY =
                        position.y -
                        pointerStartY;


                    imageX =
                        startImageX +
                        deltaX;

                    imageY =
                        startImageY +
                        deltaY;


                    clampImagePosition();

                    drawCanvas();
                }
            );


            /* =====================================================
             * STOP DRAGGING
             * ===================================================== */

            function stopDragging(event) {

                if (!isDragging) {
                    return;
                }

                isDragging = false;

                try {
                    stage.releasePointerCapture(
                        event.pointerId
                    );
                } catch (error) {
                    // Ignore pointer capture errors.
                }


                stage.classList.remove(
                    'cursor-grabbing'
                );

                stage.classList.add(
                    'cursor-grab'
                );
            }


            stage.addEventListener(
                'pointerup',
                stopDragging
            );

            stage.addEventListener(
                'pointercancel',
                stopDragging
            );

            stage.addEventListener(
                'pointerleave',
                function () {

                    /*
                     * Do not immediately stop dragging.
                     * Pointer capture keeps the drag active.
                     */
                }
            );


            /* =====================================================
             * CLOSE MODAL
             * ===================================================== */

            function closeCropModal() {

                modal.classList.add('hidden');
                modal.classList.remove('flex');

                isDragging = false;

                currentFile = null;

                input.value = '';

                ctx.clearRect(
                    0,
                    0,
                    canvasSize,
                    canvasSize
                );
            }


            /* =====================================================
             * FILE SELECTION
             * ===================================================== */

            input.addEventListener(
                'change',
                function (event) {

                    const file =
                        event.target.files[0];

                    if (!file) {
                        return;
                    }


                    /*
                     * Maximum 2 MB.
                     */
                    if (
                        file.size >
                        2 * 1024 * 1024
                    ) {

                        alert(
                            '{{ __('profile.messages.image_too_large') }}'
                        );

                        input.value = '';

                        return;
                    }


                    /*
                     * Allowed image types.
                     */
                    const allowedTypes = [
                        'image/jpeg',
                        'image/png',
                        'image/webp'
                    ];


                    if (
                        !allowedTypes.includes(
                            file.type
                        )
                    ) {

                        alert(
                            '{{ __('profile.messages.invalid_image') }}'
                        );

                        input.value = '';

                        return;
                    }


                    /*
                     * Open editor.
                     */
                    openCropModal(file);
                }
            );


            /* =====================================================
             * APPLY CROP
             * ===================================================== */

            applyButton.addEventListener(
                'click',
                function () {

                    if (!image.src) {
                        return;
                    }


                    /*
                     * Output image.
                     */
                    const outputCanvas =
                        document.createElement('canvas');

                    outputCanvas.width = 512;
                    outputCanvas.height = 512;

                    const outputContext =
                        outputCanvas.getContext('2d');


                    /*
                     * Crop area.
                     */
                    const cropX =
                        (canvasSize - cropSize) / 2;

                    const cropY =
                        (canvasSize - cropSize) / 2;


                    /*
                     * Convert canvas coordinates
                     * back to original image coordinates.
                     */
                    const sourceX =
                        (cropX - imageX) /
                        scale;

                    const sourceY =
                        (cropY - imageY) /
                        scale;

                    const sourceSize =
                        cropSize /
                        scale;


                    /*
                     * Draw cropped square.
                     */
                    outputContext.drawImage(
                        image,
                        sourceX,
                        sourceY,
                        sourceSize,
                        sourceSize,
                        0,
                        0,
                        512,
                        512
                    );


                    /*
                     * Convert to JPEG.
                     */
                    outputCanvas.toBlob(
                        function (blob) {

                            if (!blob) {

                                alert(
                                    '{{ __("Unable to process the selected image.") }}'
                                );

                                return;
                            }


                            createCroppedFile(blob);

                        },
                        'image/jpeg',
                        0.9
                    );

                }
            );


            /* =====================================================
             * CREATE CROPPED FILE
             * ===================================================== */

            function createCroppedFile(blob) {

                const croppedFile =
                    new File(
                        [blob],
                        'profile-photo.jpg',
                        {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        }
                    );


                /*
                 * Replace original input file.
                 */
                const dataTransfer =
                    new DataTransfer();

                dataTransfer.items.add(
                    croppedFile
                );

                input.files =
                    dataTransfer.files;


                /*
                 * Update preview.
                 */
                const previewUrl =
                    URL.createObjectURL(
                        croppedFile
                    );

                preview.src =
                    previewUrl;

                preview.classList.remove(
                    'hidden'
                );


                if (placeholder) {

                    placeholder.classList.add(
                        'hidden'
                    );
                }


                /*
                 * Show filename.
                 */
                fileName.textContent =
                    croppedFile.name;

                fileName.classList.remove(
                    'hidden'
                );


                /*
                 * Close modal.
                 */
                modal.classList.add(
                    'hidden'
                );

                modal.classList.remove(
                    'flex'
                );

                isDragging = false;

                currentFile = null;
            }


            /* =====================================================
             * BUTTONS
             * ===================================================== */

            closeButton.addEventListener(
                'click',
                closeCropModal
            );

            cancelButton.addEventListener(
                'click',
                closeCropModal
            );


            /* =====================================================
             * CLICK OUTSIDE MODAL
             * ===================================================== */

            modal.addEventListener(
                'click',
                function (event) {

                    if (
                        event.target === modal
                    ) {
                        closeCropModal();
                    }
                }
            );


            /* =====================================================
             * ESC KEY
             * ===================================================== */

            document.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Escape' &&
                        !modal.classList.contains(
                            'hidden'
                        )
                    ) {
                        closeCropModal();
                    }
                }
            );

        });
    </script>

</section>