<div class="room-clone-div" id="roomCloneDiv">
    <div class="row mb-2">
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-select @error('rooms.0.room_id') is-invalid @enderror"
                        id="roomId0" name="rooms[0][room_id]" aria-label="room_id">
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('rooms.0.room_id') == $room->id ? 'selected' : '' }}>
                            {{ $room->room_number }}
                        </option>
                    @endforeach
                </select>
                <label for="roomId0">Select Room&nbsp;<span class="text-danger">&lowast;</span></label>
            </div>
            @if ($errors->has('rooms.0.room_id'))
                <span class="text-danger small fw-bolder">{{ $errors->first('rooms.0.room_id') }}</span>
            @endif
        </div>

        <div class="col-2">
            <button type="button" class="btn btn-success light float-end"
                    id="addMoreRoom">Add More
            </button>
        </div>
    </div>
</div>