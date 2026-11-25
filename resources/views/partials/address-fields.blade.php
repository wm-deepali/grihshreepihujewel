@php $v = $v ?? []; @endphp
<div class="fields">
  <div class="form-group s-6">
    <input type="text" id="{{ $idp }}Name" name="{{ $px }}name" value="{{ $v['name'] ?? '' }}" placeholder=" " autocomplete="name" />
    <label for="{{ $idp }}Name">Full name</label>
  </div>
  <div class="form-group has-prefix s-6">
    <span class="prefix">+91</span>
    <input type="tel" id="{{ $idp }}Phone" name="{{ $px }}phone" value="{{ $v['phone'] ?? '' }}" placeholder=" " inputmode="numeric" maxlength="10" autocomplete="tel-national" />
    <label for="{{ $idp }}Phone">Phone number</label>
  </div>
  <div class="form-group s-4">
    <input type="text" id="{{ $idp }}Pin" name="{{ $px }}pin" value="{{ $v['pin'] ?? '' }}" placeholder=" " inputmode="numeric" maxlength="6" autocomplete="postal-code" />
    <label for="{{ $idp }}Pin">PIN code</label>
  </div>
  <div class="form-group s-4">
    <input type="text" id="{{ $idp }}City" name="{{ $px }}city" value="{{ $v['city'] ?? '' }}" placeholder=" " autocomplete="address-level2" />
    <label for="{{ $idp }}City">City</label>
  </div>
  <div class="form-group s-4">
    <input type="text" id="{{ $idp }}State" name="{{ $px }}state" value="{{ $v['state'] ?? '' }}" placeholder=" " list="stateList" autocomplete="address-level1" />
    <label for="{{ $idp }}State">State</label>
  </div>
  <div class="form-group s-5">
    <input type="text" id="{{ $idp }}House" name="{{ $px }}house" value="{{ $v['house'] ?? '' }}" placeholder=" " autocomplete="address-line1" />
    <label for="{{ $idp }}House">House / Flat no.</label>
  </div>
  <div class="form-group s-7">
    <input type="text" id="{{ $idp }}Street" name="{{ $px }}street" value="{{ $v['street'] ?? '' }}" placeholder=" " autocomplete="address-line2" />
    <label for="{{ $idp }}Street">Street / Area / Locality</label>
  </div>
  <div class="form-group s-12">
    <input type="text" id="{{ $idp }}Landmark" name="{{ $px }}landmark" value="{{ $v['landmark'] ?? '' }}" placeholder=" " />
    <label for="{{ $idp }}Landmark">Landmark (optional)</label>
  </div>
</div>

<fieldset class="type-group">
  <legend>Address type</legend>
  <div class="type-options">
    @foreach([['home', 'fa-house', 'Home'], ['work', 'fa-briefcase', 'Work'], ['other', 'fa-location-dot', 'Other']] as [$val, $icon, $label])
      <label class="type-chip">
        <input type="radio" name="{{ $px }}type" value="{{ $val }}" {{ ($v['type'] ?? 'home') === $val ? 'checked' : '' }} />
        <span><i class="fa-solid {{ $icon }}" aria-hidden="true"></i> {{ $label }}</span>
      </label>
    @endforeach
  </div>
</fieldset>