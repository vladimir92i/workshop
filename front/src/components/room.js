
import React from 'react';

function Room({ roomName }) {
    return (
        <div className='w-40 border-2 rounded-lg text-center'>
            <p>{roomName ? roomName : "room"}</p>
        </div>
    );
}

export default Room;