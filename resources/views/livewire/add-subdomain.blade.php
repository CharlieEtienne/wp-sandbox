<form wire:submit.prevent="add_subdomain">
    <input type="hidden"
           name="_token"
           value="ZubRQ8zKFexYnj9c1wm8igE7CGfvJtzW5QsGhArw">
    <div class="mt-6 sm:flex sm:flex-1 space-y-2 sm:space-y-0 sm:space-x-2">
        <div class="rounded-md shadow-sm flex-grow">
            <input wire:model.lazy="name" id="name" name="name" type="text" required autofocus
                   placeholder="Ex : charlie"
                   class="form-input block w-full sm:text-sm sm:leading-5">
        </div>
        <div class="block sm:inline-flex">
            <button type="submit"
                    wire:loading.attr="disabled"
                    wire:loading.class="bg-indigo-400"
                    wire:loading.class.remove="bg-indigo-600"
                    class="whitespace-no-wrap w-full block sm:inline-flex sm:items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition ease-in-out duration-150">
                <span wire:loading class="loader ease-linear rounded-full border-2 border-t-2 border-white border-opacity-50 h-4 w-4 mr-1"></span> Ajouter
            </button>
        </div>
    </div>
</form>
