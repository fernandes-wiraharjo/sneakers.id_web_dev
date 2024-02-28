<div class="CollectionFilters">
    <div id="bc-sf-filter-tree-mobile"><button id="bc-sf-filter-tree-mobile-button" type="button">FILTER</button></div>
    <div>
        <div id="bc-sf-filter-options-wrapper">
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>BRAND</span></h3>
                </div>
                @foreach ($brand as $item)
                    <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar">
                        <input type="checkbox" wire:model="brand" value="{{$item->id}}" wire:loading.attr="disabled">
                        {{-- <span class="Checkmark_Container"></span> --}}
                        <label>{{ strtoupper($item->brand_title) }}</label>
                    </div>
                @endforeach
            </div>
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>GENDER</span></h3>
                </div>
                <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                    <input type="checkbox" wire:model="gender" value="MENS" wire:loading.attr="disabled" id="gender">
                    <label>MEN'S</label>
                </div>
                <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                    <input type="checkbox" wire:model="gender" value="WOMENS" wire:loading.attr="disabled" id="gender">
                    <label>WOMEN'S</label>
                </div>
                <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                    <input type="checkbox" wire:model="gender" value="KIDS" wire:loading.attr="disabled" id="gender">
                    <label>KID'S</label>
                </div>
            </div>
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>AGE RANGE</span></h3>
                </div>
                <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                    <input type="checkbox" wire:model="age_range" value="GRADE_SCHOOL" wire:loading.attr="disabled" id="age_range">
                    <label>GRADE SCHOOL</label>
                </div>
                <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                    <input type="checkbox" wire:model="age_range" value="PRESCHOOL" wire:loading.attr="disabled" id="age_range">
                    <label>PRESCHOOL</label>
                </div>
                <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                    <input type="checkbox" wire:model="age_range" value="TODDLER" wire:loading.attr="disabled" id="age_range">
                    <label>TODDLER </label>
                </div>
                <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                    <input type="checkbox" wire:model="age_range" value="INFANT" wire:loading.attr="disabled" id="age_range">
                    <label>INFANT </label>
                </div>
            </div>
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>CATEGORY</span></h3>
                </div>
                @foreach ($category as $item)
                    <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                        <input type="checkbox" wire:model="category" value="{{$item->id}}" wire:loading.attr="disabled" id="category">
                        {{-- <span class="Checkmark_Container"></span> --}}
                        <label>{{ strtoupper($item->category_title) }}</label>
                    </div>
                @endforeach
            </div>
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>TAG</span></h3>
                </div>
                @foreach ($tag as $item)
                    <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                        <input type="checkbox" wire:model="tag" value="{{$item->id}}" wire:loading.attr="disabled">
                        {{-- <span class="Checkmark_Container"></span> --}}
                        <label>{{ strtoupper($item->tag_title) }}</label>
                    </div>
                @endforeach
            </div>
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>SIZE</span></h3>
                </div>
                <div>
                    <div class="grid-flow">
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="35" wire:loading.attr="disabled">
                            <label>35.5</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="36" wire:loading.attr="disabled">
                            <label>36 - 36.5</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="37" wire:loading.attr="disabled">
                            <label>37.5</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="38" wire:loading.attr="disabled">
                            <label>38 - 38.5</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="39" wire:loading.attr="disabled">
                            <label>39</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="40" wire:loading.attr="disabled">
                            <label>40 - 40.5</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="41" wire:loading.attr="disabled">
                            <label>41</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="42" wire:loading.attr="disabled">
                            <label>42 - 42.5</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="43" wire:loading.attr="disabled">
                            <label>43</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="44" wire:loading.attr="disabled">
                            <label>44 - 44.5</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="45" wire:loading.attr="disabled">
                            <label>45</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="46" wire:loading.attr="disabled">
                            <label>46 - 46.5</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="47" wire:loading.attr="disabled">
                            <label>47 - 47.5</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="48" wire:loading.attr="disabled">
                            <label>48 - 48.5</label>
                        </span>
                        <span>
                            <input type="checkbox" wire:model="size_filter" value="49" wire:loading.attr="disabled">
                            <label>49</label>
                        </span>
                    </div>
                </div>
            </div>
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>SIGNATURE PLAYER</span></h3>
                </div>
                @foreach ($signature_player as $item)
                    <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                        <input type="checkbox" wire:model="signature" value="{{$item->id}}" wire:loading.attr="disabled">
                        {{-- <span class="Checkmark_Container"></span> --}}
                        <label>{{ strtoupper($item->signature_title) }}</label>
                    </div>
                @endforeach
            </div>
            <!-- Disabled
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>SIZE</span></h3>
                </div>
                <div class="bc-sf-filter-block-content" >
                    <div class="grid-flow">
                        @foreach ($size as $count => $item)
                            <span>
                                <input type="checkbox" wire:model="size" value="{{$item->id}}">
                                <label>{{ $item->size_title}}</label>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
</div>
