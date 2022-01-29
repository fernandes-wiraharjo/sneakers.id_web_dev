<x-ladmin-form-group name="faq_title" label="Title *">
	<input type="text" placeholder="Faq Title" class="form-control" name="faq_title" id="faq_title" required value="{{ old('faq_title', $faq->faq_title) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="faq_question" label="Question *">
	<textarea placeholder="Faq Question" class="form-control" name="faq_question" id="faq_question">{{ old('faq_question', $faq->faq_question) }}</textarea>
</x-ladmin-form-group>

<x-ladmin-form-group name="faq_answer" label="Description *">
	<textarea placeholder="Faq Answer" class="form-control" name="faq_answer" id="faq_answer">{{ old('faq_answer', $faq->faq_answer) }}</textarea>
</x-ladmin-form-group>

