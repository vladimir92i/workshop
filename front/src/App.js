import { useState } from 'react';
import Floor from './page/floor';
import Connexion from './page/connexion';
function App() {
  const [connected,setConnected] = useState()
  return (
    <div className="flex justify-center">
      {/* {connected ? <Floor /> : <Connexion />} */}
      <Floor/>
    </div>
  );
}

export default App;
