<div x-data="{ open: false }">
    <!-- Button to open the modal -->
    <button @click="open = true" class="p-2 rounded-lg hover:bg-olivegreen">Sort</button>

    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="fixed inset-0 bg-black opacity-50" @click="open = false"></div>
        <div class="bg-black p-12 rounded-lg shadow-lg z-10">
            <h3 class="text-lg font-semibold mb-4">Sort Freelancers</h3>
            <form method="GET" action="{{ route('client.freelance-display') }}" class="flex flex-col">
                <select name="sort" class="p-2 bg-gray/30 rounded-lg focus:outline-none focus:ring-olivegreen">
                    <option value="">Sort By</option>
                    <option value="firstname_asc" {{ request('sort') == 'firstname_asc' ? 'selected' : '' }}>First Name
                        Ascending
                    </option>
                    <option value="firstname_desc" {{ request('sort') == 'firstname_desc' ? 'selected' : '' }}>First
                        Name
                        Descending
                    </option>
                    <option value="position_asc" {{ request('sort') == 'position_asc' ? 'selected' : '' }}>Position
                        Ascending
                    </option>
                    <option value="position_desc" {{ request('sort') == 'position_desc' ? 'selected' : '' }}>Position
                        Descending
                    </option>
                </select>
                <button type="submit" class="p-2 bg-olivegreen rounded-lg hover:bg-olivegreen">Apply</button>
            </form>
        </div>
    </div>
</div>
