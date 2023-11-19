<ul class="my-5">
    @foreach($customers as $customer)
    <li wire:key='{{$customer->id}}' wire:click="chooseCustomer({{$customer->id}})"
        class="dark:bg-dark-eval-3 flex gap-2 justify-around items-center rounded-md dark:text-white bg-white text-gray-700 p-2 cursor-pointer">
        {{$customer->dpi}} {{$customer->name}} {{$customer->last_name}} <img src="{{asset(" storage/" .
            $customer->photo)}}" alt="customer photo" width="100">
        <li />
        @endforeach
</ul>