<article class="p-4 flex space-x-4 shadow-md rounded-md m-4">
  
  <img src="/images/{{ $recipee->imagepath }}" alt="" class="flex-none w-18 h-18 rounded-lg object-cover" width="144" height="144" />
  <div class="min-w-0 relative flex-auto sm:pr-20 lg:pr-0 xl:pr-20">
    <h2 class="text-lg font-semibold text-black mb-0.5">
      <a href="/recipees/view/{{ $recipee->id }}">{{ $recipee->name }}</a>
    </h2>
    <div class="">
      <p class="font-extralight"><span class="text-yellow-500">Ingredients:</span> {{ count($recipee->ingredients) }}</p>
      <p class="font-extralight"><span class="text-yellow-500">Description:</span> {{ $recipee->description }}</p>
    </div>
  </div>
  
</article>