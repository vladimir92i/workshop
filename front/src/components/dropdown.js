import Dropdown from 'react-bootstrap/Dropdown';

function DropDown() {
  return (
    <Dropdown>
      <Dropdown.Toggle variant="success" id="dropdown-basic">
        seléctionner l'étage
      </Dropdown.Toggle>

      <Dropdown.Menu>
        <Dropdown.Item> RDC </Dropdown.Item>
        <Dropdown.Item>Etage 1</Dropdown.Item>
        <Dropdown.Item>Etage 2</Dropdown.Item>
      </Dropdown.Menu>
    </Dropdown>
  );
}

export default DropDown;