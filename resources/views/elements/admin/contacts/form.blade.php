{!!Form::open([
	'files' => true,
	'route' => ['admin.contacts.update', $contact->id],
	'method' => 'PUT',
	'class' => 'ls-form row'
])!!}
	{!!Form::model($contact, ['route' => ['admin.contacts.update', $contact->id]]) !!}
	<fieldset>
		<label class="ls-label col-md-9">
			<b class="ls-label-text">Data de tratativa</b>
			{!!Form::text('deal_date', ($contact->deal_date->year > 0) ? $contact->deal_date : '', ['placeholder' => 'dd/mm/aaaa', 'class' => "datepicker"])!!}
		</label>
	</fieldset>
	@include('elements.admin.shared.form_actions', ['route_cancel' => route('admin.contacts.index')])
{!!Form::close()!!}