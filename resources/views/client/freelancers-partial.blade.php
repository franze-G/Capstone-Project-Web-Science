@foreach ($freelancers as $freelancer)
<x-card.card :user="$freelancer" :star-rating="$freelancer->star_rating" />
@endforeach